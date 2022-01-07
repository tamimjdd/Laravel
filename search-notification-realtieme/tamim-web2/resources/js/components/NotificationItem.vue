<template>
    <div class="wrap">
        <a :href="Url">
            {{ this.unread.data.follower_name }} followed you
        </a>
        <div>
            {{ date | diffForHumans }}
        </div>
    </div>
</template>

<script>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
    export default{

        props:['unread'],
        created() {
        dayjs.extend(relativeTime);
    },

    filters: {
        diffForHumans: (date) => {
            if (!date){
                return null;
            }

            return dayjs(date).fromNow();
        }
    },

        data(){
            return{
                Url:"",
                date: new Date(),
            }
        },

        mounted(){
            this.Url="/profile/"+this.unread.data.follower_id
        }
    }
</script>
