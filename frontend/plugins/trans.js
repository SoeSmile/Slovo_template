import Vue from 'vue';


/**
 * language mixin
 */
Vue.mixin(
    {
        computed: {
            trans() {
                return this.$store.getters.trans;
            },
        },
        methods : {
            lang(str) {
                let data = str.split('.');
                let key;

                switch (data.length) {
                    case 2:
                        key = this.trans[data[0]][data[1]];
                        break;
                    case 3:
                        key = this.trans[data[0]][data[1]][data[2]];
                        break;
                    case 4:
                        key = this.trans[data[0]][data[1]][data[2]][data[3]];
                        break;
                    default:
                        key = this.trans[data[0]];
                        break;
                }

                return key;
            }
        }
    });