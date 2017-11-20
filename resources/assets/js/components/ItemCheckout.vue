<template>
    <table class="uk-table uk-table-divider">
        <thead>
            <tr>
                <th class="uk-table-shrink" colspan="3"><b>ITEMS ({{ bags.length }})</b></th>
            </tr>
        </thead>
        <tbody v-for="bag in bags">
            <tr>
                <td><img class="uk-preserve-width" :src="'/'+bag.options.photo" width="130" alt=""></td>
                <td class="uk-table-link">
                  <ul class="uk-list uk-margin-small-top">
                    <li><b>{{ bag.name }}</b></li>
                    <li class="uk-margin-remove"><span class="uk-text-small">Color: {{ bag.options.color }}</span></li>
                    <li class="uk-margin-remove"><span class="uk-text-small">Size : {{ bag.options.size }}</span></li>
                  </ul>
                </td>
                <td class="uk-text-nowrap">
                <ul class="uk-grid-small uk-flex-middle" uk-grid>
                  <li>{{ bag.qty }}</li>
                </ul>
                </td>
                <td class="uk-text-nowrap">{{ bag.price }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    import axios from 'axios';
    export default {
        props: ['bag_api'],
        data () {
            return {
                bags: {}
            }
        },

        created () {
            var self = this;
            self.getBag();
        },

        methods: {
            getBag: function () {
                var self = this;
                axios.get(this.bag_api, {
                })
                .then(function (response) {
                  self.bags = response.data.bags;

                  Event.fire('bags', response);
                })
                .catch(function (error) {
                  console.log(error);
                });
            }
        }
    }
</script>
