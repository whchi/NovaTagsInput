<template>
  <default-field :field="field" :errors="errors">
    <template slot="field">
      <vue-tags-input
        v-model="tag"
        :tags="tags"
        @tags-changed="tagsChanged"
        v-bind="field.props"
        :autocompleteItems="filteredItems"
      />
    </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import VueTagsInput from '@johmun/vue-tags-input'

export default {
  data() {
    return {
      tag: '',
      tags: [],
      autocompleteItems: [],
    }
  },
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  created() {
    this.initStyles()
  },

  mounted() {
    // Set up default parameters
    this.autocompleteItems = this.field.autocompleteItems
      ? this.field.autocompleteItems
      : this.autocompleteItems
  },

  methods: {
    initStyles() {
      for (const [k, v] of Object.entries(this.field.style_variables)) {
        document.documentElement.style.setProperty(k, v)
      }
    },
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = ''
      this.value = JSON.parse(this.field.value) || ''
      if (this.value !== '') {
        let tags = []
        this.value.forEach(function(item, index) {
          tags.push(item)
        })
        this.tags = tags
      }
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      let val = this.tags.length ? JSON.stringify(this.tags) : []
      formData.append(this.field.attribute, val)
    },

    /**
     * Update the field's internal value.
     */
    handleChange(value) {
      this.value = value
    },

    /**
     * Handles the tagChanged event
     * @param newTags
     */
    tagsChanged(newTags) {
      this.tags = newTags
    },
  },

  computed: {
    filteredItems() {
      return this.autocompleteItems.filter(i => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1
      })
    },
  },

  components: { VueTagsInput },
}
</script>
