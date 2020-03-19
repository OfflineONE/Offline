<template>
    <div>
        <div class="level">
            <img :src="avatar" width="50" height="50" class="mr-4">

            <h1 v-text="user.name">

            </h1>
        </div>

        <form v-if="canUpdate" method="POST" enctype="multipart/form-data">

                <image-upload name="avatar" class="mr-5" @loaded="onLoad"></image-upload>

                <!--                <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light">Add Avatar</button>-->
            </form>

    </div>

</template>

<script>
    import ImageUpload from './ImageUpload.vue';

    export default {

        components: { ImageUpload },

        props: ['user'],

        data() {
            return {
                avatar: this.user.avatar_path
            };
        },

        computed: {
            canUpdate() {
                return this.authorize(user => user.id === this.user.id);
            }
        },

        methods: {
            onLoad(avatar) {
                this.avatar = avatar.src;

                //persist to the server
                this.persist(avatar.file);
            },

            persist(avatar) {
                let data = new FormData();

                data.append('avatar', avatar);
                axios.post(`/api/users/${this.user.name}/avatar`, data)
                    .then(() => flash('Avatar uploaded'));
            }
        }

    }
</script>

<style scoped>

</style>
