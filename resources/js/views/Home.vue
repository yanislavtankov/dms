<template>
<div>
<b-container>
    <b-jumbotron header="Laravel / Vue.js" lead="Example document management system and source code">
        <p>For more information visit <a href="https://github.com/yanislavtankov/dms" target="_blank">GitHub</a></p>
        <b-btn variant="primary" href="/#/about">Details</b-btn>
    </b-jumbotron>
</b-container>
<b-container>
  <transition-group name="thumbnailfade" tag="div">
    <img v-for="thumb in filteredImages"
         :key="thumb.id"
         @click="showLightbox(thumb.name)"
         :src="thumbnailDir + thumb.name"
         :alt="thumb.alt"
         :title="thumb.alt" />
  </transition-group>

  <lightbox id="mylightbox"
      ref="lightbox"
      :images="images"
      :directory="thumbnailDir"
      :filter="galleryFilter"
      :timeoutDuration="5000"
  />
</b-container>
</div>

</template>

<script>

var photoDir =
  '/img/';

var imageList =
  [{'name':'1.jpg',
    'alt':'Vue/Laravel App',
    'filter':'app',
    'id':'1.jpg' },

   {'name':'2.jpg',
    'alt':'Vue/Laravel App',
    'filter':'app',
    'id':'2.jpg'  },

   {'name':'3.jpg',
    'alt':'Vue/Laravel App',
    'filter':'app',
    'id':'3.jpg'  },

   {'name':'4.jpg',
    'alt':'Vue/Laravel App',
    'filter':'app',
    'id':'4.jpg'  },

   {'name':'5.jpg',
    'alt':'Vue/Laravel App',
    'filter':'app',
    'id':'5.jpg'  },

   {'name':'6.jpg',
    'alt':'Vue/Laravel App',
    'filter':'app',
    'id':'6.jpg'  },

   {'name':'7.jpg',
    'alt':'Vue/Laravel App',
    'filter':'app',
    'id':'7.jpg'  },

   {'name':'8.jpg',
    'alt':'Vue/Laravel App',
    'filter':'app',
    'id':'8.jpg'  },

   {'name':'9.jpg',
    'alt':'Vue/Laravel App',
    'filter':'app',
    'id':'9.jpg'  },

   {'name':'10.jpg',
    'alt':'Vue/Laravel App',
    'filter':'app',
    'id':'10.jpg'  },

   {'name':'11.jpg',
    'alt':'Vue/Laravel App',
    'filter':'app',
    'id':'11.jpg'  },

   {'name':'12.jpg',
    'alt':'Vue/Laravel App',
    'filter':'app',
    'id':'12.jpg'  } ];

export default {
  data() {
    return {
      thumbnailDir: photoDir,
      images: imageList,
      galleryFilter: 'all'
    }
  },
  methods: {
    showLightbox: function(imageName) {
      this.$refs.lightbox.show(imageName);
    },
    updateFilter(filterName) {
      this.galleryFilter = filterName;
    }
  },
  computed: {
    filteredImages: function() {
      if (this.galleryFilter === 'all') {
        return this.images;
      } else {
        return this.images.filter(image => image.filter === this.galleryFilter);
      }
    }
  }
}

</script>

<style>

img {
  width: 270px;
  height: 180px;
  margin: 20px;
  border-radius: 3px;
  cursor: pointer;
  transition: all 0.4s ease;
}

.thumbnailfade-leave-active,
.thumbnailfade-enter-active {
  transition: all 0.4s ease;
}

.thumbnailfade-enter-active {
  transition-delay: 0.4s;
}

.thumbnailfade-enter,
.thumbnailfade-leave-to {
  opacity: 0;
}

</style>
