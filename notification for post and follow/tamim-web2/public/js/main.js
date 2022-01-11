
function markNotificationAsRead(count){
    if(count!==0){
        $.get('/markAsRead');
    }
}
