<template>
<div :id="'reply-'+id"
     class="flex flex-col rounded mt-2 bg-white">
    <div class="p-3"
         :class="isBest ? 'bg-green-400' : 'bg-white'">
        <div class="level">
            <h5 class="flex">
                    <a :href="'/profiles/'+reply.owner.name"
                       v-text="reply.owner.name"
                    >
                </a>said<span v-text="ago"></span>...
            </h5>
                <div v-if="signedIn">
                    <favorite :reply="reply"></favorite>
                </div>
        </div>
    </div>

        <div class="flex-auto p-6">
            <div v-if="editing">
                <form
                    @submit="update">

                <div class="mb-4">
                    <wysiwyg v-model="body"></wysiwyg>
                </div>

                <button
                    class="border-2"
                    type="submit"
                >Update</button>

                <button class="border-2"
                        type="button"
                        @click="editing = false"
                >Cancel</button>

            </form>

            </div>

            <div ref="body" v-else>
                <highlight :content="body"></highlight>
            </div>

        </div>

        <div class="py-3 px-6 bg-grey-lighter border-t-1 border-grey-light level" v-if="authorize('owns', reply) || authorize('owns', reply.thread)">

        <div v-if="authorize('owns', reply)">
            <button
                type="button"
                class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline py-1 px-2 text-sm leading-tight"
                @click="editing = true">Edit</button>

            <button
                type="button"
                class="border bg-danger"
                @click="destroy"
            >
                Delete
            </button>
        </div>
            <button
                class="border py-2 px-4 rounded text-sm ml-auto"
                @click="markBestReply"
                v-if="authorize('owns', reply.thread)"
            >
                Best reply?
            </button>
    </div>

</div>
</template>

<script>
    import Favorite from "./Favorite.vue";
    import moment from 'moment';
    import Highlight from './Highlight.vue';

    export default {
        props: ['reply'],

        components: { Favorite, Highlight },

        data() {
            return {
                editing: false,
                id: this.reply.id,
                body: this.reply.body,
                isBest: this.reply.isBest,
            };
        },

        computed: {
            ago() {
                return moment(this.reply.created_at).fromNow();
            },
        },

        created() {
           window.events.$on('best-reply-selected', id => {
               this.isBest = (id === this.id)
           })
        },

        methods: {

            update() {
                axios
                .patch('/replies/' + this.id, {
                    body: this.body
                })
                .catch(error => {
                    flash(error.response.data, 'danger');
                });

                this.editing = false;

                flash('Updated!');
            },

            destroy() {
                axios.delete('/replies/' + this.id);

                this.$emit('deleted', this.id);
            },

            markBestReply() {
                axios.post('/replies/'+this.id+'/best')

                window.events.$emit('best-reply-selected', this.id)
            }
        }
    }
</script>

