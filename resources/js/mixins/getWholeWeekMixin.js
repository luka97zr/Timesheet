export default {
    methods: {
        getWholeWeek(day) {
            let now = moment(day).clone().startOf('isoWeek');
			let end = moment(day).clone().endOf('isoWeek')
            const dates = [];

				while( now.isSameOrBefore(end)) {
					dates.push(now.format('YYYY-MMMM-DD'));
					now.add(1,'days')
					this.weekdays = dates;
				}
        },
    }
}