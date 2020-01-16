## Markdown-based Backend CMS application for a blog.

The Application is an API driven, Markdown-based Backend CMS for a blog-like website.

> Note: On the upcoming 2020 February release of Laravel, Taylor will move all the Authentication Controllers out of the main framework and into the Laravel UI package. Moreover, in February he will also release a stable version for the Laravel Airlock Package, which will provide a more SPA authentication approach.
Both of the above features will be included once they are out.

**Technology stack**

- Laravel 6.10 and up
- Vuejs
- Vue Router
- Vue Js Modal
- Vuex
- TailwindCSS

**Included Features**

- The application is built around a single user.
- Posts CRUD. Includes a status flag to provide the ability to have a draft post.
- Every Post belongs to a single Category.
- Subscribers with the unsubscribe feature.

> In the current version, the application uses Laravel Passports CreateFreshApiToken trait to consume its own API, and serve a Web-Based Mobile-Friendly User Interface. The login functionality is accomplished via the default Laravel authentication with the added difference of the session being set to 30 days ( like tweeter ).

- Ability to upload images from the markdown to use inside the posts.
- All the uploaded images are set to be saved on the public assets folder. I choose this approach because everyone has a different way to handle images, and I wanted to keep it a simple as possible. All the functionality is provided through a HandleImages trait, to provid the flexibility of swapping the implementation easily.

- Every API endpoint controller has a corresponding Test to back it up.

> The Javascript used for the backend is compiled on a different file than the frontend. This is mainly to provide the ability to choose a blade-like approach for the frontend.

**Features in development**

- I decided to implement Vuex for the backend and I am now in the process of updating the UI.
- There might be some updates to the Tests and the API endpoints while moving to Vuex.

**Future Improvements**

- I will add a basic frotend template to be able to quickly have the blog ready uppon installation of the application.

**License**

The Application is open-sourced software licensed under the <a href="https://github.com/Sidirgot/MarkdownBlogCMS/blob/master/LICENSE.md">MIT license</a>.