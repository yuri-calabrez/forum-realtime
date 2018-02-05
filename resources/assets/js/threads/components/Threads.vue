<template>
    <div class="card">
        <div class="card-content">
            <div class="card-title">{{ title }}</div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{thread}}</th>
                        <th>{{replies}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="thread in threads_response.data" :class="{'lime lighten-4': thread.fixed}">
                        <td>{{thread.id}}</td>
                        <td>{{thread.title}}</td>
                        <td>{{thread.replies_count || 0}}</td>
                        <td>
                            <a :href="'threads/' + thread.id" class="btn">{{open}}</a>
                             <a :href="'threads/pin/' + thread.id" 
                                class="btn blue" v-if="logged.role === 'admin'">Pin</a>
                            <a :href="'threads/close/' + thread.id" 
                                class="btn red" v-if="logged.role === 'admin'">Close Thread</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-content">
            <div class="card-title">{{ newThread }}</div>

            <form @submit.prevent="save()">
                <div class="input-field">
                    <input type="text" :placeholder="threadTitle" v-model="threads_to_save.title">
                </div>
                <div class="input-field">
                   <textarea class="materialize-textarea" :placeholder="threadBody" 
                   v-model="threads_to_save.body"></textarea>    
                </div>
                <button class="btn red accent-2" type="submit">{{send}}</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
      props: [
          'title',
          'thread',
          'replies',
          'open',
          'newThread',
          'threadBody',
          'threadTitle',
          'send'
      ],
      data(){
          return {
              threads_response: [],
              logged: window.user || {},
              threads_to_save: {
                  title: '',
                  body: ''
              }
          }
      },
      mounted(){
         this.getThreads();
         Echo.channel('new.thread').listen('NewThread', (e) => {
             if(e.thread) {
                 this.threads_response.data.splice(0, 0, e.thread);
             }
         });
      },
      methods: {
          save() {
              axios.post('/threads', this.threads_to_save)
                    .then(() => {
                        this.getThreads();
                    });
          },
          getThreads(){
               axios.get('/threads').then((response) => {
                    this.threads_response = response.data;
                });
          }
      }
    }
</script>
