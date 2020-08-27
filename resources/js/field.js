Nova.booting((Vue, router, store) => {
  Vue.component('index-nova-tags-input', require('./components/IndexField'))
  Vue.component('detail-nova-tags-input', require('./components/DetailField'))
  Vue.component('form-nova-tags-input', require('./components/FormField'))
})
