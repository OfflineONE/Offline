<template>
    <div class="new-reply">
        <div v-if="signedIn">
          <div class="mb-4">
              <wysiwyg name="body"
                       class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded mt-2"
                       v-model="body"
                       placeholder="Say something ..."
                       ref="trix"
                       :shouldClear="completed"
              ></wysiwyg>
          </div>

           <button type="submit"
                   class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default bg-blue mt-2"
                   @click="addReply"
           >
               Post
           </button>

        </div>
            <p class="text-center mt-3"
               v-else>
                Please<a href="/login">sign in</a> to participate in this discussion.
            </p>
        </div>
</template>

<script>
    export default {

    data() {
         return{
            body: '',
            completed: false,
         }
    },

    mounted() {
        $('#body').atwho({
              at: "@",
              delay: 750,
              callbacks: {
                remoteFilter: function(query, callback) {
                      $.getJSON("/api/users", {name: query}, function(usernames) {
                        callback(usernames)
                      });
                }
              }
        });
    },

        methods: {
            addReply() {
                axios
                    .post(location.pathname + '/replies', { body: this.body })
                    .catch(error => {
                        console.log('ERROR');
                        flash(error.response.data, 'danger');
                    })
                    .then(({data}) => {
                        this.body = '';
                        this.completed = true;

                        flash('Your reply has been posted.');

                        this.$emit('created', data)
                    });
            }
    }
}
</script>

<style scoped>
 .new-reply {
     padding: 15px;
     background-color: #fff;
     border: 1px solid #e3e3e3;
 }
</style>
