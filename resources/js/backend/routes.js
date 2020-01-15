import Posts from './components/posts/index'
import ShowPost from './components/posts/show'
import CreatePost from './components/posts/create'

import Categories from './components/categories/index'

import Subscribers from './components/subscribers/index'

import Settings from './components/settings/settings'
import SocialMedia from './components/settings/socialMedia/index'
import AdminAccount from './components/settings/adminAccount/index'

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
            path: '/manage/post/:slug',
            component: ShowPost,
            name: 'show-post',
            props: true,
        },

        {
            path: '/categories',
            component: Categories,
            name: 'categories',
        },
        {
            path: '/manage/post/create',
            component: CreatePost,
            name: 'create-post',
        },
        {
            path: '/manage/settings',
            component: Settings,
            name: 'settings',
            children: [
                {
                    path: 'social-media',
                    component: SocialMedia,
                    name: 'social-media',
                },
                {
                    path: 'admin-account',
                    component: AdminAccount,
                    name: 'admin-account',
                },
            ],
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