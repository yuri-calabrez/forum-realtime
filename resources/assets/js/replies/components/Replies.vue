<template>
    <div>
        <div class="card">
            <div class="card-content">
                <span class="card-title">Yuri {{replied}}</span>
                <blockquote>
                    Iusto sit hic excepturi. Voluptatem similique dolore nihil non in odio magnam. 
                    Quaerat sit consequatur qui eligendi. Sit excepturi tempore voluptas dolorem est 
                    blanditiis eum. Voluptas est omnis ipsam.
                </blockquote>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <span class="card-title">Yuri {{replied}}</span>
                <blockquote>
                    Iusto sit hic excepturi. Voluptatem similique dolore nihil non in odio magnam. 
                    Quaerat sit consequatur qui eligendi. Sit excepturi tempore voluptas dolorem est 
                    blanditiis eum. Voluptas est omnis ipsam.
                </blockquote>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <span class="card-title">Yuri {{replied}}</span>
                <blockquote>
                    Iusto sit hic excepturi. Voluptatem similique dolore nihil non in odio magnam. 
                    Quaerat sit consequatur qui eligendi. Sit excepturi tempore voluptas dolorem est 
                    blanditiis eum. Voluptas est omnis ipsam.
                </blockquote>
            </div>
        </div>

        <div class="card grey lighten-4">
            <div class="card-content">
               <span class="card-title">{{reply}}</span>

               <form>
                   <div class="input-field">
                       <textarea name="" rows="10" :placeholder="yourAnswer" class="materialize-textarea"></textarea>
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
            'send'
        ]
    }
</script>
