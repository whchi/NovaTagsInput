<template>
  <div v-html="fieldLabel"></div>
</template>

<script>
let vm;

export default {
  data() {
    return {
      tags: '',
      fieldLabel: '',
      tagsWrapperClass: 'nti-tags-wrapper',
      tagClass: 'nti-tag',
    };
  },
  props: ['resourceName', 'field'],
  created() {
    this.initStyles();
  },
  mounted() {
    vm = this;
    this.newField = this.field;
    let items = null;
    if (this.field.value) {
      if (Array.isArray(this.field.value)) {
        items = this.field.value;
      } else {
        items = JSON.parse(this.field.value);
      }
      items.forEach(function (item, index) {
        vm.tags += '<span class="' + vm.tagClass + '">' + item.text + '</span>';
      });
      this.fieldLabel =
        '<div class="' + this.tagsWrapperClass + '">' + vm.tags + '</div>';
    }
  },
  methods: {
    initStyles() {
      for (const [k, v] of Object.entries(this.field.style_variables)) {
        document.documentElement.style.setProperty(k, v);
      }
    },
  },
};
</script>
