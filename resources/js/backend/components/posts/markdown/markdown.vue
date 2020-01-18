<template>
    <div>
        <button class="btn btn-indigo focus:outline-none my-3" @click="clean" v-show="frontend"><i class="fas fa-eye-slash"></i></button>
        <button class="btn btn-indigo focus:outline-none my-3" @click="compiledMarkdown" v-show="!frontend">Preview <i class="fab fa-html5"></i></button>

        <button class="btn btn-indigo focus:outline-none my-3" @click="$modal.show('markdownimage')"><i class="fas fa-image"></i></button>

        <textarea v-model="body" class="bg-main-dark p-2 w-full" rows="30" required v-show="!frontend"></textarea>

        <div class="markdown_css container mx-auto bg-main-dark p-2 rounded" v-html="frontend" v-show="frontend"></div>


        <MarkdownImage />
    </div>
</template>

<script>
import Marked from 'marked'
import MarkdownImage from './markdownimage'

export default {
    props: {
        val:{
            type: String,
            required: false
        }
    },

    components: { MarkdownImage },

    data() {
        return {
            frontend: '',
            body: ''
        }
    },
    mounted() {
        if (this.val) {
            this.body = this.val
        }
    },
    watch: {
        body() {
            this.$emit('body', this.body)
        }
    },

    methods: {
        compiledMarkdown() {
            this.frontend = Marked(this.body)
        },
        clean() {
            this.frontend = ''
        },
    }

}
</script>

<style lang="scss">
.markdown_css {

    body {
        color: #444;
        font-family: Georgia, Palatino, 'Palatino Linotype', Times, 'Times New Roman', serif;
        font-size: 12px;
        line-height: 1.5em;
        padding: 1em;
        margin: auto;
        max-width: 42em;
        background: #fefefe;
    }

    a {
        color: #0645ad;
        text-decoration: none;
    }

    a:visited {
        color: #0b0080;
    }

    a:hover {
        color: #06e;
    }

    a:active {
        color: #faa700;
    }

    a:focus {
        outline: thin dotted;
    }

    a:hover,
    a:active {
        outline: 0;
    }

    ::-moz-selection {
        background: rgba(255, 255, 0, 0.3);
        color: #000;
    }

    ::selection {
        background: rgba(255, 255, 0, 0.3);
        color: #000;
    }

    a::-moz-selection {
        background: rgba(255, 255, 0, 0.3);
        color: #0645ad;
    }

    a::selection {
        background: rgba(255, 255, 0, 0.3);
        color: #0645ad;
    }

    p {
        margin: 1em 0;
        word-break: break-word;
    }

    img {
        max-width: 100%;
        border-radius: 10px;
        border: 0;
        -ms-interpolation-mode: bicubic;
        vertical-align: middle;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: normal;
        line-height: 1em;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    h4,
    h5,
    h6 {
        font-weight: bold;
    }

    h1 {
        font-size: 2.5em;
    }

    h2 {
        font-size: 2em;
    }

    h3 {
        font-size: 1.5em;
    }

    h4 {
        font-size: 1.2em;
    }

    h5 {
        font-size: 1em;
    }

    h6 {
        font-size: 0.9em;
    }

    blockquote {
        background: #00b1b3;
        opacity: 0.7;
        border-left: 10px solid #009fa1;
        margin: 1.5em 10px;
        padding: 0.5em 10px;
        quotes: "\201C""\201D""\2018""\2019";
        font-style: italic;
        & p {
            display: inline;
        }
    }

    blockquote:before {
        color: #ccc;
        content: open-quote;
        font-size: 4em;
        line-height: 0.1em;
        margin-right: 0.25em;
        vertical-align: -0.4em;
        }

    blockquote:after {
        color: #ccc;
        content: close-quote;
        font-size: 4em;
        line-height: 0.1em;
        margin-right: 0.25em;
        vertical-align: -0.4em;
    }

    hr {
        display: block;
        border: 0;
        border-top: 1px solid #00b1b3;
        border-bottom: 1px solid #00b1b3;
        margin: 1em 0;
        padding: 0;
    }

    code {
        font-family: monospace, monospace;
        _font-family: 'courier new', monospace;
        font-size: 0.98em;
    }

    pre {
        background: #1a202c;
        padding: 20px 20px;
        border-radius: 10px;
        color: #fff;
        overflow-x: auto;
        margin: 20px 0px;
    }

    b,
    strong {
        font-weight: bold;
    }

    ul,
    ol {
        list-style-type: initial;
        margin: 1em 0;
        padding: 0 0 0 2em;
    }

    li p:last-child {
        margin: 0;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    td {
        vertical-align: top;
    }

    @media only screen and (min-width: 480px) {
        body {
            font-size: 14px;
        }
    }

    @media only screen and (min-width: 768px) {
        body {
            font-size: 16px;
        }
    }

    @media print {
    * {
        background: transparent !important;
        color: black !important;
        filter: none !important;
        -ms-filter: none !important;
    }

    body {
        font-size: 12pt;
        max-width: 100%;
    }

    a,
    a:visited {
        text-decoration: underline;
    }

    hr {
        height: 1px;
        border: 0;
        border-bottom: 1px solid black;
    }

    a[href]:after {
        content: " (" attr(href) ")";
    }

    abbr[title]:after {
        content: " (" attr(title) ")";
    }

    .ir a:after,
    a[href^="javascript:"]:after,
    a[href^="#"]:after {
        content: "";
    }

    pre,
    blockquote {
        border: 1px solid #999;
        padding-right: 1em;
        page-break-inside: avoid;
    }

    tr,
    img {
        page-break-inside: avoid;
    }

    img {
        max-width: 100% !important;
    }

    p,
    h2,
    h3 {
        orphans: 3;
        widows: 3;
    }

    h2,
    h3 {
        page-break-after: avoid;
    }
    }

}
</style>