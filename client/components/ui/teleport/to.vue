<!-- https://github.com/Mechazawa/vue2-teleport/blob/master/src/Teleport.vue -->
<template>
  <div :class="classes">
    <slot/>
  </div>
</template>

<script>
export default {
  props: {
    to: {
      type: [String, Boolean, HTMLElement],
      required: true,
    },
    where: {
      type: String,
      default: 'after',
    },
    disabled: Boolean,
  },

  data() {
    return {
      nodes: [],
      waiting: false,
      observer: null,
      parent: null,
    };
  },

  watch: {
    to: 'maybeMove',
    where: 'maybeMove',
    disabled(value) {
      if (value) {
        this.disable();
        this.teardownObserver();
      } else {
        this.bootObserver();
        this.move();
      }
    },
  },
  
  beforeDestroy() {
    // Move back
    this.disable();

    // Stop observing
    this.teardownObserver();
  },

  computed: {
    classes() {
      if (this.disabled) {
        return ['teleporter'];
      }

      return ['teleporter', 'hidden'];
    },
  },

  methods: {
    maybeMove() {
      if (!this.disabled) {
        this.move();
      }
    },

    move() {
        this.waiting = false;

        this.parent = typeof this.to=="object"? this.to: document.querySelector(this.to);
        console.log(this.parent);

        if (!this.parent) {
            this.disable();

            this.waiting = true;

            return;
        }

        if (this.where === 'before') {
            this.parent.prepend(this.getFragment());
        } else {
            this.parent.appendChild(this.getFragment());
        }
    },

    disable() {
      this.$el.appendChild(this.getFragment());
      this.parent = null;
    },

    // Using a fragment is faster because it'll trigger only a single reflow
    // See https://developer.mozilla.org/en-US/docs/Web/API/DocumentFragment
    getFragment() {
      const fragment = document.createDocumentFragment();

      this.nodes.forEach(node => fragment.appendChild(node));

      return fragment;
    },

    onMutations(mutations) {
      // Makes sure the move operation is only done once
      let shouldMove = false;

      for (let i = 0; i < mutations.length; i++) {
        const mutation = mutations[i];
        const filteredAddedNodes = Array.from(mutation.addedNodes).filter(node => !this.nodes.includes(node));

        if (Array.from(mutation.removedNodes).includes(this.parent)) {
          this.disable();
          this.waiting = !this.disabled;
        } else if (this.waiting && filteredAddedNodes.length > 0) {
          shouldMove = true;
        }
      }

      if (shouldMove) {
        this.move();
      }
    },

    bootObserver() {
      if (this.observer) {
        return;
      }

      this.observer = new MutationObserver(mutations => this.onMutations(mutations));

      this.observer.observe(document.body, {
        childList: true,
        subtree: true,
        attributes: false,
        characterData: false,
      });
    },

    teardownObserver() {
      if (this.observer) {
        this.observer.disconnect();
        this.observer = null;
      }
    },
  },

  mounted() {
    setTimeout(() => {
        this.nodes = Array.from(this.$el.childNodes);
    
        if (!this.disabled) {
          this.bootObserver();
        }
    
        this.maybeMove();
    }, 100);
  },
};
</script>

<style scoped>
.hidden {
  visibility: hidden;
  display: none;
}
</style>