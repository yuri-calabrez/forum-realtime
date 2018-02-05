<template>
    <div>
        <div class="card" v-for="data in replies" :class="{'lime lighten-4': data.highlited}">
            <div class="card-content">
                <span class="card-title">{{data.user.name}} {{replied}}</span>
                <blockquote>{{data.body}}</blockquote>
            </div>

            <div class="card-action" v-if="logged.role === 'admin'">
                <a :href="`/replies/highlight/${data.id}`">Em destaque</a>
            </div>
        </div>

        <div class="card grey lighten-4">
            <div class="card-content">
               <span class="card-title">{{reply}}</span>
               <form @submit.prevent="save()" v-if="is_closed == 0">
                   <div class="input-field">
                       <textarea name="" rows="10" v-model="reply_to_save.body" :placeholder="yourAnswer" class="materialize-textarea"></textarea>
                   </div>

                   <button type="submit" class="btn red accent-2">{{send}}</button>
               </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'replied',
            'reply',
            'yourAnswer',
            'send',
            'threadId',
            'isClosed'
        ],
        data(){
            return {
                replies: [],
                logged: window.user || {},
                thread_id: this.threadId,
                is_closed: this.isClosed,
                reply_to_save: {
                    body: '',
                    thread_id: this.threadId
                }
            }
        },
        methods: {
            getReplies(){
                axios.get(`/replies/${this.thread_id}`)
                    .then((response) => {
                        this.replies = response.data;
                    })
            },
            save(){
                axios.post('/replies', this.reply_to_save)
                    .then(() => {
                        this.getReplies();
                    });
            }
        },
        mounted(){
            this.getReplies();

            Echo.channel(`new.reply.${this.thread_id}`)
                .listen('NewReply', (e) => {
                    if(e.reply) {
                        this.getReplies();
                    }
                });
        }
    }
</script>
