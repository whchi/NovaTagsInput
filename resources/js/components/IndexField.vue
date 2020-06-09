<template>
    <div v-html="fieldLabel"></div>
</template>

<script>
let vm;

export default {
    data() {
        return {
            tags: "",
            fieldLabel: "",
            tagsWrapperClass: "nti-tags-wrapper",
            tagClass: "nti-tag"
        };
    },
    props: ["resourceName", "field"],
    mounted() {
        vm = this;
        this.newField = this.field;
        if (this.field.value && this.field.value !== "[]") {
            let items = JSON.parse(this.field.value);
            items.forEach(function(item, index) {
                vm.tags +=
                    '<span class="' +
                    vm.tagClass +
                    '">' +
                    item.text +
                    "</span>";
            });

            this.fieldLabel =
                '<div class="' +
                this.tagsWrapperClass +
                '">' +
                vm.tags +
                "</div>";
        }
    }
};
</script>
