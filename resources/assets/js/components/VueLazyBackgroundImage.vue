<template>
  <img :src="imageSource" :alt="alt" :width="width" :class="imageClass" :style="imageStyle" @error="imageLoadError">
</template>

<script>
export default {
  props: {
    imageSource: {
      type: String,
      required: true
    },
    imageClass: {
      type: String,
      required: false,
      default: ''
    },
    loadingImage: {
      type: String,
      required: true
    },
    errorImage: {
      type: String,
      required: true
    },
    width: {
      type: String,
      required: false,
      default: ''
    },
    alt: {
      type: String,
      required: false,
      default: ''
    },    
    imageStyle: {
      type: String,
      required: false,
      default: ''
    }
  },
  methods: {
    imageLoadError () {
      this.imageSource = this.errorImage
    }
  } 
}
</script>

