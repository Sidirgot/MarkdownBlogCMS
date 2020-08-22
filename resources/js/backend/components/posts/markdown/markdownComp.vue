<template>
    <div>
        <button class="btn btn-blue focus:outline-none my-3" @click="clean" v-show="frontend">
            <svg width="20" height="20" class="mx-1" viewBox="0 0 20 20">
                <path fill="#fff" d="M18.303,4.742l-1.454-1.455c-0.171-0.171-0.475-0.171-0.646,0l-3.061,3.064H2.019c-0.251,0-0.457,0.205-0.457,0.456v9.578c0,0.251,0.206,0.456,0.457,0.456h13.683c0.252,0,0.457-0.205,0.457-0.456V7.533l2.144-2.146C18.481,5.208,18.483,4.917,18.303,4.742 M15.258,15.929H2.476V7.263h9.754L9.695,9.792c-0.057,0.057-0.101,0.13-0.119,0.212L9.18,11.36h-3.98c-0.251,0-0.457,0.205-0.457,0.456c0,0.253,0.205,0.456,0.457,0.456h4.336c0.023,0,0.899,0.02,1.498-0.127c0.312-0.077,0.55-0.137,0.55-0.137c0.08-0.018,0.155-0.059,0.212-0.118l3.463-3.443V15.929z M11.241,11.156l-1.078,0.267l0.267-1.076l6.097-6.091l0.808,0.808L11.241,11.156z"></path>
            </svg>
        </button>

        <button class="btn btn-blue focus:outline-none my-3" @click="compiledMarkdown" v-show="!frontend">
            <svg width="20" height="20" class="mx-1" viewBox="0 0 20 20">
                <path fill="#fff" d="M10,6.978c-1.666,0-3.022,1.356-3.022,3.022S8.334,13.022,10,13.022s3.022-1.356,3.022-3.022S11.666,6.978,10,6.978M10,12.267c-1.25,0-2.267-1.017-2.267-2.267c0-1.25,1.016-2.267,2.267-2.267c1.251,0,2.267,1.016,2.267,2.267C12.267,11.25,11.251,12.267,10,12.267 M18.391,9.733l-1.624-1.639C14.966,6.279,12.563,5.278,10,5.278S5.034,6.279,3.234,8.094L1.609,9.733c-0.146,0.147-0.146,0.386,0,0.533l1.625,1.639c1.8,1.815,4.203,2.816,6.766,2.816s4.966-1.001,6.767-2.816l1.624-1.639C18.536,10.119,18.536,9.881,18.391,9.733 M16.229,11.373c-1.656,1.672-3.868,2.594-6.229,2.594s-4.573-0.922-6.23-2.594L2.41,10l1.36-1.374C5.427,6.955,7.639,6.033,10,6.033s4.573,0.922,6.229,2.593L17.59,10L16.229,11.373z"></path>
            </svg>
        </button>

        <button class="btn btn-blue focus:outline-none my-3" @click="$modal.show('markdownimage')">
            <svg width="20" height="20" viewBox="0 0 20 20">
                <path fill="#fff" d="M18.555,15.354V4.592c0-0.248-0.202-0.451-0.45-0.451H1.888c-0.248,0-0.451,0.203-0.451,0.451v10.808c0,0.559,0.751,0.451,0.451,0.451h16.217h0.005C18.793,15.851,18.478,14.814,18.555,15.354 M2.8,14.949l4.944-6.464l4.144,5.419c0.003,0.003,0.003,0.003,0.003,0.005l0.797,1.04H2.8z M13.822,14.949l-1.006-1.317l1.689-2.218l2.688,3.535H13.822z M17.654,14.064l-2.791-3.666c-0.181-0.237-0.535-0.237-0.716,0l-1.899,2.493l-4.146-5.42c-0.18-0.237-0.536-0.237-0.716,0l-5.047,6.598V5.042h15.316V14.064z M12.474,6.393c-0.869,0-1.577,0.707-1.577,1.576s0.708,1.576,1.577,1.576s1.577-0.707,1.577-1.576S13.343,6.393,12.474,6.393 M12.474,8.645c-0.371,0-0.676-0.304-0.676-0.676s0.305-0.676,0.676-0.676c0.372,0,0.676,0.304,0.676,0.676S12.846,8.645,12.474,8.645"></path>
            </svg>
        </button>

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