module.exports = {
    theme: {
        extend: {
            colors: {
                'navbar': '#112943',
                'navbar-light': '#021c33',
                'main-dark': '#021c33',
                'facebook': '#4267b2',
                'twitter': '#38A1F3',
                'linkedin': '#0077B5',
                'sidirgot': '#00b1b3',
                'sidirgot-dark': '#009fa1',
            },
        },
        inset: {
            '4': '4em',
        },
    },
    variants: {
        padding: ['responsive', 'hover', 'focus'],
        backgroundColor: ['responsive', 'group-hover', 'first', 'last', 'odd', 'even', 'hover', 'focus', 'active', 'visited', 'disabled'],
    },
}