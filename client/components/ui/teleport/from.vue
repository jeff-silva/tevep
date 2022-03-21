<template>
    <div>
        <slot></slot>
    </div>
</template>

<script>
export default {
    props: {
        target: {type:[Boolean, String, HTMLElement]},
        where: {default:"before"},
    },

    methods: {
        move() {
            setTimeout(() => {
                let target = typeof this.target=="object"? this.target: document.querySelector(this.target);

                Array.from(target.querySelectorAll('*')).forEach(node => {
                    console.log(node.constructor.prototype);

                    for(let i in node) {
                        // for(let i in node.constructor.prototype) {
                        //     if (0!==i.indexOf('on')) continue;
                        //     if (!node[i]) continue;
                        //     console.log(i);
                        // }


                        // if (0!==i.indexOf('on')) continue;
                        // // if (i=='onkeyup') console.log(i, node[i]);
                        // if (!node[i]) continue;
                        // console.log(node[i]);
                    }
                });
                

                // const _getClone = () => {
                //     let clone = target.cloneNode(true);
                //     Array.from(target.childNodes).forEach(node => {
                //         console.log(node.prototype);
                //     });
                //     return clone;
                // };

                // _getClone();




                // this.$el.innerHTML = '';
                // this.$el.appendChild(target.cloneNode(true));


                // const fragment = document.createDocumentFragment();
                // fragment.appendChild(document.importNode(target, true));
                // this.$el.innerHTML = '';
                // this.$el.appendChild(fragment);


                // const fragment = document.createDocumentFragment();
                // Array.from(target.childNodes).forEach(node => fragment.appendChild(node));
                // console.log({fragment});
                // this.$el.innerHTML = '';
                // this.$el.appendChild(fragment);
                // target.appendChild(fragment);



                // const _getFragment = () => {
                //     const fragment = document.createDocumentFragment();
                //     Array.from(target.childNodes).forEach(node => fragment.appendChild(node));
                //     return fragment;
                // };

                // let frag1 = _getFragment();
                // let frag2 = _getFragment();
                // console.log({frag1, frag2});


                // target.appendChild(frag1);
                // this.$el.innerHTML = '';
                // this.$el.appendChild(frag2);
            }, 10);
        },
    },

    mounted() {
        this.move();
    },
}
</script>