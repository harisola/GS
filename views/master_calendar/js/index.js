'use strict';

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

// INIT

var alt = new Alt();

window.requestAnimFrame = function () {
	return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function (callback) {
		window.setTimeout(callback, 1000 / 60);
	};
}();

// UTILS
function getLastTwoChr(thisString) {
	return thisString.substr(-2);
}

function format(date, format) {
	return date.toString(format);
}

function monthKey(date) {
	return format(date, 'yyyyMM');
}

function dayKey(date) {
	return format(date, 'MMddyyyy');
}

function nextMonth(date) {
	date = new Date(date);
	var next = date.getMonth() + 1;

	var res = new Date(date.setMonth(next % 12));

	if (next > 11) {
		res = new Date(res.setFullYear(res.getFullYear() + 1));
	}

	return res;
}

function prevMonth(date) {
	date = new Date(date);
	var prev = date.getMonth() - 1;
	var res = undefined;

	if (prev < 0) {
		res = new Date(date.setMonth(prev + 12));

		res = new Date(res.setFullYear(res.getFullYear() - 1));
	} else {
		res = new Date(date.setMonth(prev));
	}

	return res;
}

function daysOfMonth(date) {
	return [].concat(trailingDays(date), currentDays(date), leadingDays(date));
}

function currentDays(date) {
	var days = [];
	var day = new Date(date);
	for (var i = 1; i < 32; i++) {
		day = new Date(day.setDate(i));
		if (!(day.valueOf() && day.getMonth() == date.getMonth())) {
			return days;
		}
		days.push({ value: new Date(day), type: 'current', key: dayKey(day) });
	}

	return days;
}

function trailingDays(date) {
	var days = [];
	var day = new Date(date);
	day = new Date(day.setDate(1) - 86400000);
	while (day.getDay() != 6) {
		days.unshift({ value: day, type: 'trailing' });
		day = new Date(day.valueOf() - 86400000);
	}

	return days;
}

function leadingDays(date) {
	var days = [];
	var day = new Date(date.setDate(1));
	day = new Date(day.setMonth(day.getMonth() % 12 + 1));
	day = new Date(day.setDate(1));
	while (day.getDay() != 0) {
		days.push({ value: day, type: 'leading' });
		day = new Date(day.valueOf() + 86400000);
	}

	return days;
}

// COMPONENTS

var Calendar = function (_React$Component) {
	_inherits(Calendar, _React$Component);

	function Calendar(props) {
		_classCallCheck(this, Calendar);

		var _this = _possibleConstructorReturn(this, _React$Component.call(this, props));

		_this.onChange = function (state) {
			_this.setState(state);
		};

		_this.state = CalendarStore.getState();
		return _this;
	}

	Calendar.prototype.componentDidMount = function componentDidMount() {
		this.setAnimationListener();
		this.scrollToFocus();
		this.windowWidth = window.innerWidth;
		CalendarStore.listen(this.onChange);
	};

	Calendar.prototype.componentWillUpdate = function componentWillUpdate(nextProps, nextState) {
		if (nextState.shifted) {
			this.focusMonthOffset = this.focusMonth.offsetTop() - this.refs.root.scrollTop;
		}
	};

	Calendar.prototype.componentDidUpdate = function componentDidUpdate() {
		if (this.state.shifted) {
			this.refs.root.scrollTop = this.focusMonth.offsetTop() - this.focusMonthOffset;
		}
	};

	Calendar.prototype.componentWillUnmount = function componentWillUnmount() {
		CalendarStore.unlisten(this.onChange);
	};

	Calendar.prototype.scrollToFocus = function scrollToFocus() {
		this.refs.root.scrollTop = this.focusMonth.offsetTop() - 32;
	};

	Calendar.prototype.checkScroll = function checkScroll() {
		if (this.windowWidth !== window.innerWidth) {
			this.scrollToFocus();
			this.windowWidth = window.innerWidth;
		}
	};

	Calendar.prototype.setAnimationListener = function setAnimationListener() {
		var _this2 = this;

		requestAnimFrame(function () {
			_this2.checkScroll();
			_this2.checkFocusMonth();
		});
	};

	Calendar.prototype.checkFocusMonth = function checkFocusMonth() {
		var focusedTop = this.focusMonth.offsetTop();
		var focusedHeight = this.focusMonth.scrollHeight();
		var scrollTop = this.refs.root.scrollTop;

		if (scrollTop > focusedTop + focusedHeight - 44 + 1) {
			CalendarActions.incrementFocusMonth();
		} else if (scrollTop < focusedTop - 44 - 1) {
			CalendarActions.decrementFocusMonth();
		}
		this.setAnimationListener();
	};

	Calendar.prototype.setRef = function setRef(ref, idx) {
		if (idx - this.state.focusMonthIdx === 0) {
			this.focusMonth = ref;
		}
	};

	Calendar.prototype.render = function render() {
		var _this3 = this;

		return React.createElement(
			'div',
			{ id: 'calendar-container', ref: 'root' },
			React.createElement(CalendarHeader, null),
			React.createElement(
				'div',
				{ id: 'calendar-body-container' },
				this.state.months.map(function (month, idx) {
					return React.createElement(Month, { days: month.days,
						month: month.month,
						today: _this3.state.today,
						key: month.key,
						fromFocus: idx - _this3.state.focusMonthIdx,
						ref: function ref(_ref) {
							_this3.setRef(_ref, idx);
						} });
				})
			)
		);
	};

	return Calendar;
}(React.Component);

var CalendarHeader = function (_React$Component2) {
	_inherits(CalendarHeader, _React$Component2);

	function CalendarHeader(props) {
		_classCallCheck(this, CalendarHeader);

		var _this4 = _possibleConstructorReturn(this, _React$Component2.call(this, props));

		_this4.days = ['WK', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
		return _this4;
	}

	CalendarHeader.prototype.previousMonth = function previousMonth() {
		CalendarActions.decrementMonth();
	};

	CalendarHeader.prototype.nextMonth = function nextMonth() {
		CalendarActions.incrementMonth();
	};

	CalendarHeader.prototype.render = function render() {
		return React.createElement(
			'div',
			{ id: 'calendar-header-container' },
			React.createElement(
				'div',
				{ id: 'calendar-header-days-container' },
				React.createElement(
					'ol',
					{ id: 'calendar-header-days' },
					this.days.map(function (day, idx) {
						return React.createElement(
							'li',
							{ className: 'calendar-header-day', key: idx },
							day
						);
					})
				)
			)
		);
	};

	return CalendarHeader;
}(React.Component);

var Month = function (_React$Component3) {
	_inherits(Month, _React$Component3);

	function Month() {
		_classCallCheck(this, Month);

		return _possibleConstructorReturn(this, _React$Component3.apply(this, arguments));
	}

	Month.prototype.mapWeeks = function mapWeeks(callback, idx) {
		var start = 0;
		var weeks = [];
		while (this.props.days[start]) {
			weeks.push(callback.call(this, this.props.days.slice(start, start + 7), start / 7));
			start += 7;
		}

		return weeks;
	};

	Month.prototype.offsetTop = function offsetTop() {
		return this.refs.root.offsetTop;
	};

	Month.prototype.scrollHeight = function scrollHeight() {
		return this.refs.root.scrollHeight;
	};

	Month.prototype.isToday = function isToday(day) {
		return this.props.today.key === day.key;
	};

	Month.prototype.renderWeek = function renderWeek(week, idx) {
		var _this6 = this;

		return React.createElement(
			'div',
			{ className: 'week-row'},
			React.createElement (
				'div',
				{ className: 'week-no' },
				'13'
			),
			React.createElement (
				'div',
				{ className: 'calendar-week', key: idx },
				week.map(function (day, idx) {
					return React.createElement(CalendarDay, {
						day: day, key: idx, isToday: _this6.isToday(day) });
				})
			)
		);
	};

	Month.prototype.render = function render() {
		var _this7 = this;

		var headerClasses = classNames({
			'calendar-days-header-container': true,
			'active': this.props.fromFocus === 0
		});

		return React.createElement(
			'div',
			{ className: 'calendar-days-container', ref: 'root' },
			React.createElement(
				'div',
				{ className: headerClasses },
				React.createElement(
					'h4',
					{ className: 'calendar-days-header primary-header', ref: 'header' },
						React.createElement(
							'span',
							{ className: 'month' },
							format(this.props.month, 'MMMM ')
						),
						React.createElement(
							'span',
							{ className: 'year' },
							format(this.props.month, 'yyyy')
						)
				),
				React.createElement(
					'h4',
					{ className: 'calendar-days-header scrolling-header', ref: 'header' },
					React.createElement(
						'span',
						{ className: 'month' },
						format(this.props.month, 'MMMM ')
					),
					React.createElement(
						'span',
						{ className: 'year' },
						format(this.props.month, 'yyyy')
					)
				)
			),
			React.createElement(
				'div',
				{ className: 'calendar-days-content' },
				this.mapWeeks(function (week, idx) {
					return _this7.renderWeek(week, idx);
				})
			)
		);
	};

	return Month;
}(React.Component);

var CalendarDay = function (_React$Component4) {
	_inherits(CalendarDay, _React$Component4);

	function CalendarDay() {
		_classCallCheck(this, CalendarDay);

		return _possibleConstructorReturn(this, _React$Component4.apply(this, arguments));
	}

	CalendarDay.prototype.isWeekend = function isWeekend() {
		var day = this.props.day.value.getDay();
		return day === 0 || day === 6;
	};

	CalendarDay.prototype.render = function render() {
		var _classNames;
		var calYear;
		var calMonth;
		var calDate;
		
		var dayClasses = classNames((_classNames = {
			'calendar-day': true
		}, _classNames[this.props.day.type] = true, _classNames['weekend'] = this.isWeekend(), _classNames['today'] = this.props.isToday, _classNames));

		calYear = this.props.day.value.getYear();
		calYear = getLastTwoChr(calYear.toString());
		calDate = this.props.day.value.getDate();
		
		if (this.props.day.value.getMonth() == 0){
			calMonth = 'Jan'
		}else if (this.props.day.value.getMonth() == 1){
			calMonth = 'Feb'
		}else if (this.props.day.value.getMonth() == 2){
			calMonth = 'Mar'
		}else if (this.props.day.value.getMonth() == 3){
			calMonth = 'Apr'
		}else if (this.props.day.value.getMonth() == 4){
			calMonth = 'May'
		}else if (this.props.day.value.getMonth() == 5){
			calMonth = 'Jun'
		}else if (this.props.day.value.getMonth() == 6){
			calMonth = 'Jul'
		}else if (this.props.day.value.getMonth() == 7){
			calMonth = 'Aug'
		}else if (this.props.day.value.getMonth() == 8){
			calMonth = 'Sep'
		}else if (this.props.day.value.getMonth() == 9){
			calMonth = 'Oct'
		}else if (this.props.day.value.getMonth() == 10){
			calMonth = 'Nov'
		}else if (this.props.day.value.getMonth() == 11){
			calMonth = 'Dec'
		}
		
		
		
		return React.createElement(
			'div',
			{ className: dayClasses },
			React.createElement(
				'div',
				{ className: 'calendar-day-content leftBoxDate' },
					React.createElement(
						'a',
						{ className: 'dateHere tooltipp', href: '#', "data-toggle": 'modal', "data-target": '#AddEvent' },
						this.props.day.value.getDate(),
						React.createElement(
							'div',
							{ MonthName: 'HijriDateMonth' },
							calMonth,
							React.createElement(
								'span',
								{ className: 'tooltipptext' },
								'Add Event'
							)
						)
					),
					React.createElement(
						'div',
						{ className: 'HijriDate' },
						'14',
							React.createElement(
								'div',
								{ className: 'HijriDateMonth' },
								'Saffar'
							)
					)
			),
			React.createElement(
				'div',
				{ className: 'ParameterTopSet' },
				'',
				React.createElement(
					'a',
					{ className: 'HolidayParameter HolidayParOn tooltipp', href: '#', "data-toggle": 'modal', "data-target": '#SetHolidayParameter' },
					'H',
					React.createElement(
						'span',
						{ className: 'tooltipptext' },
						'Holiday Parameter'
					)
				),
				React.createElement(
					'a',
					{ className: 'StaffParameter StaffParOn tooltipp', href: '#', "data-toggle": 'modal', "data-target": '#SetStaffParameter' },
					'TP',
					React.createElement(
						'span',
						{ className: 'tooltipptext' },
						'Staff Parameter'
					)
				),
				React.createElement(
					'a',
					{ className: 'StudentParameter StudentParOn tooltipp', href: '#', "data-toggle": 'modal', "data-target": '#SetStudentParameter' },
					'SP',
					React.createElement(
						'span',
						{ className: 'tooltipptext' },
						'Student Parameter'
					)
				),
				React.createElement(
					'a',
					{ className: 'ScheduleFollowup ScheduleFolOn tooltipp', href: '#', "data-toggle": 'modal', "data-target": '#SetScheduleFollowup' },
					'SF',
					React.createElement(
						'span',
						{ className: 'tooltipptext' },
						'Schedule Followup'
					)
				)
			),
			React.createElement(
				'div',
				{ className: 'eventListingHere' },
				'',
				React.createElement(
					'a',
					{ className: 'HolidayParameterSet', href: '#', "data-toggle": 'modal', "data-target": '#SetHolidayParameter' },
					'Pakistan Day'
				),
				React.createElement(
					'a',
					{ className: 'StaffParameterSet', href: '#', "data-toggle": 'modal', "data-target": '#SetStaffParameter' },
					'M - PTM Middle'
				),
				React.createElement(
					'a',
					{ className: 'StudentParameterSet', href: '#', "data-toggle": 'modal', "data-target": '#SetStudentParameter' },
					'J - PTM Junior'
				),
				React.createElement(
					'a',
					{ className: 'ScheduleFollowupSet', href: '#', "data-toggle": 'modal', "data-target": '#SetScheduleFollowup' },
					'Saturday - 20th March'
				),
				React.createElement(
					'a',
					{ className: 'ViewMoreHere', href: '#', "data-toggle": 'modal', "data-target": '#SetScheduleFollowup' },
					'View 3 more..'
				)
			)
		);
	};

	return CalendarDay;
}(React.Component);

// ACTIONS

var _CalendarActions = function _CalendarActions() {
	_classCallCheck(this, _CalendarActions);

	this.generateActions('incrementFocusMonth', 'decrementFocusMonth');
};

var CalendarActions = alt.createActions(_CalendarActions);

// STORES

var _CalendarStore = function () {
	function _CalendarStore() {
		_classCallCheck(this, _CalendarStore);

		this.bindActions(CalendarActions);
		var date = new Date();
		this.today = { value: date, key: dayKey(date) };

		this.focusMonth = this.constructMonth(new Date());
		this.focusMonthIdx = 5;
		this.months = [this.focusMonth];
		this.pushMonths(5);
		this.unshiftMonths(5);
	}

	_CalendarStore.prototype.onIncrementFocusMonth = function onIncrementFocusMonth() {
		this.shifted = false;
		this.focusMonth = this.months[++this.focusMonthIdx];
		if (this.focusMonthIdx > 7) {
			this.shiftForwards();
		}
	};

	_CalendarStore.prototype.onDecrementFocusMonth = function onDecrementFocusMonth() {
		this.shifted = false;
		this.focusMonth = this.months[--this.focusMonthIdx];
		if (this.focusMonthIdx < 3) {
			this.shiftBackwards();
		}
	};

	_CalendarStore.prototype.shiftForwards = function shiftForwards() {
		this.pushMonths(3);
		this.months.splice(0, 3);
		this.focusMonthIdx -= 3;
		this.shifted = true;
	};

	_CalendarStore.prototype.shiftBackwards = function shiftBackwards() {
		this.unshiftMonths(3);
		this.months.splice(10, 3);
		this.focusMonthIdx += 3;
		this.shifted = true;
	};

	_CalendarStore.prototype.constructMonth = function constructMonth(date) {
		return {
			key: monthKey(date),
			month: date,
			days: daysOfMonth(date)
		};
	};

	_CalendarStore.prototype.pushMonths = function pushMonths(n) {
		for (var i = 0; i < n; i++) {
			this.months.push(this.constructMonth(nextMonth(this.months[this.months.length - 1].month)));
		}
	};

	_CalendarStore.prototype.unshiftMonths = function unshiftMonths(n) {
		for (var i = 0; i < n; i++) {
			this.months.unshift(this.constructMonth(prevMonth(this.months[0].month)));
		}
	};

	return _CalendarStore;
}();

var CalendarStore = alt.createStore(_CalendarStore);

// RENDER

React.render(React.createElement(Calendar, null), document.getElementById('app'));