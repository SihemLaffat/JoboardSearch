
window.onload = ()=> {
    let calendarEl = document.querySelector('#calendar')
    
    let calendar = new FullCalendar.Calendar(calendarEl, {
        
        initialView: 'dayGridMonth',
        locale: 'fr',
        timeZone: 'Europe/Paris',
        headerToolbar: {
            start: 'prev,next,today',
            center: 'title',
            end: 'dayGridMonth,timeGridWeek' }
        
    })
    
     calendar.render();
 }

      
