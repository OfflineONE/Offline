<template>
    <div class="sm:invisible md:invisible lg:visible xl:visible">
        <div class="dropdown">
            <a href="#"
               class="dropdown-toggle ml-4 bg-blue-500 border-white hover:no-underline hover:bg-blue-400 rounded-full text-white px-2 py-0.8 text-lg"
               data-toggle="dropdown"
               aria-haspopup="true"
               aria-expanded="false"
               role="button"
            >
                Categories
                <span class="caret"></span>
            </a>

            <div class="dropdown-menu">
                <div class="input-wrapper">
                    <input type="text"
                           class="form-control"
                           v-model="filter"
                           placeholder="Filter Offers..."/>
                </div>

                <ul class="list-group channel-list">
                    <li class="list-group-item" v-for="channel in filteredChannels">
                        <a :href="`/threads/${channel.slug}`" v-text="channel.name"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</template>

<style lang="scss">
    .channel-dropdown {
        padding:0;
    }

    .input-wrapper {
        padding:.5rem 1rem;
    }

    .channel-list {
        max-height: 400px;
        overflow:auto;
        margin-bottom:0;

        .list-group-item {
            border-radius:0;
            border-left: none;
            border-right: none;
        }
    }
</style>

<script>
    export default {
        data() {
            return {
                channels: [],
                toggle: false,
                filter: ''
            };
        },

        created() {
            axios.get('/api/channels').then(({ data }) => (this.channels = data));
        },

        computed: {
            filteredChannels() {
                return this.channels.filter(channel => {
                    return channel.name
                        .toLowerCase()
                        .startsWith(this.filter.toLocaleLowerCase());
                });
            }
        }
    };
</script>