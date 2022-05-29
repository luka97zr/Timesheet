import { fill, get } from "lodash";
import moment from "moment"
const calendar = {
    calendarLabel: document.querySelector('.table-navigation__center'),
    btnNext: document.querySelector('.table-navigation__next'),
    btnPrev: document.querySelector('.table-navigation__prev'),
     months: moment.months(),
    table: document.querySelector('.table-body'),
    year: new Date().getFullYear(),
    month: new Date().getMonth(),
    calendarArr: [],
   init() {
    this.btnNext.addEventListener('click',this.nextMonth.bind(this))
    this.btnPrev.addEventListener('click',this.prevMonth.bind(this))
    this.sendJSON(this.year,this.month)
   },
   getDate: function(year,month){
       this.calendarArr = []
    this.calendarLabel.innerHTML =  `${this.year}, ${moment(this.month+1,'MM').format('MMMM')}`
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
    document.cookie = `date=${JSON.stringify(Object.values(this.calendarArr))}`;
    return this.calendarArr
   },

   sendJSON: async function(year,month){
       try{
        const resp = await fetch('/GetMonth',{
            method : 'POST',
            headers: {
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest'
              },
            body : JSON.stringify(this.getDate(year,month))
       })
       const data = await resp.json();
       this.table.innerHTML = Object.values(data).join('');
       }catch(err){
           console.error(err)
       }
   },
   nextMonth: function() {
       if(this.month < 11)  this.month++;
        this.sendJSON(this.year,this.month)
   },
   prevMonth: function() {
    if(this.month > 0)  this.month--;
    this.sendJSON(this.year,this.month)
   }
 }

 export default calendar;