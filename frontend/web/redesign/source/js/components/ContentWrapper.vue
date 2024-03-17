<template>
    <component :is="tag" :class="tagClass">
        <slot v-bind="content" />
    </component>
</template>

<script setup>

let _uniqId = 0;
let _uniqName = function() {
    return "content-wrapper-" + this._uniqId;
};

export default {
    name: "content-wrapper",
    props: {
        name: {
            type: String,
            default: _uniqName
        },
        tag: {
            type: String,
            default: "div"
        },
        tagClass: {
          type: String,
          default: ""
        },
        default: {
            default: null
        },
        storeData: {
            type: String,
            default: _uniqName
        },
    },
    computed: {
        data: {
            get: function() {
                return this.$store.state[this.storeData];
            },
            set: function(value) {
                this.$store.$set(this.storeData, value);
            }
        },
        content() {
            let data =
                typeof this.data === "object" && !Array.isArray(this.data)
                    ? this.data
                    : { data: this.data };
            return data;
        }
    },
    beforeCreate() {
        this._uniqId = _uniqId++;
    },
    created() {
        this.data = this.default;
    },
    beforeDestroy() {
        this.$store.$unset(this.storeData);
    }
};
</script>
