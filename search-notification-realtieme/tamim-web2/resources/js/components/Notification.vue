<template>
     <div class="dropdown inline-block relative pr-4" id="markasread" @mouseover="markNotificationAsRead" >

            <span class="mr-1">
                <i class="fas fa-bell"></i>
                <span class="inline-flex items-center
                justify-center px-2 py-1 text-xs font-bold
                leading-none text-red-100 bg-red-600
                rounded-full">{{unreadNotifications.length}}</span>
            </span>

        <ul class="dropdown-menu absolute hidden text-gray-700 pt-1 overflow-y-auto h-32">
            <li>
               <notification-item v-for="unread in unreadNotifications" :unread="unread" :key="unread.id"></notification-item>

            </li>
        </ul>
        </div>
</template>

<script>

import NotificationItem from './NotificationItem.vue';
export default{
    props:['unreads','userid'],
    components:{NotificationItem},

    data(){
        return {
            unreadNotifications: this.unreads,

        }
    },
    methods:{
        markNotificationAsRead(){
            if(this.unreadNotifications.length){
                axios.get('/markAsRead');
            }
        }
    },

    mounted(){
        console.log('component mounted.')
        Echo.private('App.Models.User.' + this.userid)
        .notification((notification) => {

            let newUnreadNotifications={data:{follower_id:notification.follower_id,follower_name: notification.follower_name}};
            this.unreadNotifications.unshift(newUnreadNotifications);
        });
    }
}
</script>
