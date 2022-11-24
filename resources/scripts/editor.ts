import { ref } from 'vue'

export const options = ref({
  modules: {
    toolbar: [
      { header: [1, 2, 3, 4, 5, 6, 7] },
      'bold', // bold
      'italic', // italics
      'underline', // underline
      'strike', // strike-through
      'code-block', // code bloc
      'clean', // clean
      'divider',
      { list: 'ordered' },
      { list: 'bullet' },
      { indent: '-1' },
      { indent: '+1' },
      'divider',
      'blockquote', // blockquote
      'video', // video
      'link', // url
    ],
  },
  syntax: true,
  readOnly: false,
})
