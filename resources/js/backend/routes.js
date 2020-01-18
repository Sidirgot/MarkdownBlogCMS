import Posts from './components/posts/index'
import ShowPost from './components/posts/show'
import CreatePost from './components/posts/create'

import Categories from './components/categories/index'

import Subscribers from './components/subscribers/index'

import Settings from './components/settings/settings'

import NotFound from './components/partials/notfound'

export default {
    mode: 'history',

    linkActiveClass: 'font-bold',

    routes: [
        {
            path: '/manage/posts',
            component: Posts,
            name: 'posts',
        },

        {
            path: '/manage/post/create',
            component: CreatePost,
            name: 'create-post',
        },

        {
            path: '/manage/post/:id',
            component: ShowPost,
            name: 'show-post',
            props: true,
        },

        {
            path: '/manage/categories',
            component: Categories,
            name: 'categories',
        },

        {
            path: '/manage/settings',
            component: Settings,
            name: 'settings',
        },

        {
            path: '/manage/subscribers',
            component: Subscribers,
            name: 'subscribers',
        },
        {
            path: '/manage/*',
            component: NotFound
        }
    ],
}