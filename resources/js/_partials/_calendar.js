import moment from "moment"

const calendar = {
     months: moment.months(),
    year: new Date().getFullYear(),
    month: new Date().getMonth(),
    calendarArr: [],
   init() {

    this.getDate(this.year,this.month)
   },
   getDate: function(year,month){
       this.calendarArr = []
    const startDate = moment([year,month])
        .clone()
        .startOf('month')
        .startOf('isoWeek');
        const endDate = moment([year,month]).clone().endOf('month').endOf('week');
        const day = startDate.clone().subtract(1,'days')
    while(day.isBefore(endDate,"day")) {
        this.calendarArr.push(
            Array(7)
            .fill(0)
            .map(()=>day.add(1,"day").clone().format('DD'))
        );
    }
    return this.calendarArr
   },

//    sendJSON: async function(year,month){
//        try{
//         const resp = await fetch('/GetMonth',{
//             method : 'POST',
//             headers: {
//                 "Content-Type": "application/json",
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
//                 'X-Requested-With': 'XMLHttpRequest'
//               },
//             body : JSON.stringify(this.getDate(year,month))
//        })
//        const data = await resp.json();
//        this.table.innerHTML = Object.values(data).join('');
//        }catch(err){
//            console.error(err)
//        }
//    },
   nextMonth: function() {
        this.month++;
       if(this.month === 12){
           this.month = 0;
           this.year++
       }
        this.getDate(this.year,this.month)
   },
   prevMonth: function() {
    this.month--;
    if(this.month < 0){
    this.month = 11;
    this.year--
    }
    this.getDate(this.year,this.month)
   }
 }

 export default calendar;