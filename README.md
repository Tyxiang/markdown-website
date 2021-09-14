# Markdown Single Page Web

Build a single page web by markdown.

[Demo](http://forw.cc/markdown-single-page-web/demo)

## 1. Markdown

```markdown
# h1

h1 content

## h2

h2 content

### h3

h3 content

#### h4

h4 content
```

## 2. Markdown to Web

| Markdown   | Web              | Other |
| ---------- | ---------------- | ----- |
| h1         | html head title  |       |
| h1 content | page description |       |
| h2         | unit             |       |
| h2 content | unit description |       |
| h3         | card             |       |
| h3 content | card description |       |
| h4         | pop              |       |
| h4 content | pop description  |       |

## 3. Config

Use `## CONFIG` in the markdown file to add elements for the page:

| Markdown         | Web                | Other            |
| ---------------- | ------------------ | ---------------- |
| `### title`      | html head title    | will overwrite # |
| `### icon`       | html head icon     |                  |
| `### keywords`   | html head keywords |                  |
| `### logo`       | header logo        |                  |
| `### header-nav` | header nav         |                  |
| `### footer-nav` | footer nav         |                  |
| `### ending`     | footer ending      |                  |

Example:

```markdown
## CONFIG

### title

smallest

### icon

image/logo.ico

### keywords

single page web one 

### logo

![logo](image/logo.png)

### header-nav

- [About](#about)
- [Product](#product)
- [Support](#support)
- [Connect](#connect)

### footer-nav

[Declare](#) - [E-mail](#) - [Office](#) - [thanks](#)

### ending

Copyright © 2021 forw.cc  
All rights reserved  

```

