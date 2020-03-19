<template>
    <button :class="classes" @click="subscribe" v-if="signedIn">Subscribe</button>
</template>

<script>
    export default {
        props: ['active'],

        data() {
            return {
                isActive: this.active
            }
        },

        computed:{
            classes() {
                return ['btn', this.isActive ? 'btn-secondary' : 'btn-primary'];
            }
        },

        methods: {
            subscribe() {
                axios[(this.isActive ? 'delete' : 'post')](location.pathname + '/subscriptions');

                this.isActive = ! this.isActive;
            }
        }
    }
</script>
