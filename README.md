## Markdown-based Backend CMS application for a blog.

The Application is an API driven, Markdown-based Backend CMS for a blog-like website.

## Technology stack

### Backend
    Laravel 7
    Laravel Passport
    Laravel Ui
    Intervention/image

### Frontend
    Vuejs
    Vuex
    Vue Router
    Vue Js Modal
    Vue Toasted
    TailwindCSS

## Features

     In the current version, the application uses Laravel Passports CreateFreshApiToken trait to consume its own API, and serve a Web-Based Mobile-Friendly User Interface. The login functionality is accomplished via the default Laravel authentication with the session being set to 30 days.

     Once Logged in the entire backend CMS is a Single Page Vue Application.

- The application is built around a single user.
  
- Posts CRUD. Includes a status flag to provide the ability to have a draft post.
  
- Every Post belongs to a single Category.
  
- Subscribers with the unsubscribe feature.
  
- Ability to upload images from the markdown to use inside the posts.
  - All the uploaded images are set to be saved on the storage public disk. 
   Since everyone has a different way to handle images, I wanted to keep it as simple as possible. All the functionality is provided through a HandleImages trait, to provide the flexibility of swapping the implementation easily.

- 85% of the application is covered from Test Driven Development.

> The Javascript files for backend and frontend are compiled separately. This is mainly to provide the ability to choose a blade-like approach for the frontend and also to keep the javascript on the frontend to a minimum.

## Future development

- Handle the backend errors in the frontend SPA.

- I am thinking of implementing a way to send emails from within the application. Haven't made up my mind on the final implementation. 
  
Any suggestions are always welcome.

## License

The Application is open-sourced software licensed under the <a href="https://github.com/Sidirgot/MarkdownBlogCMS/blob/master/LICENSE.md">MIT license</a>.