# Manual

## 1. Data File

- The markdown data file used to define the page is placed under `file/`;
- In the data file, `# CONFIG` is the configuration content, and the other heading 1 is the page content;
- `file/Config.md` is the default configuration file;
- `file/Default.md` is the default page file;
- `file/xxx.md` is other page file;
- The page content in the data file will replace the page content in `file/Config.md`;
- The configuration content in the data file will update the configuration content in `file/Config.md`;

## 2. Configuration Item

### 2.1. Website Name

```markdown
## name

website name
```

### 2.2. Page Title

```markdown
## title

page title
```

Title priority from low to high:

1. `# CONFIG ## title` in `Config.md`;
1. `# {title}` of the page content in `file/xxx.md`;
1. `# CONFIG ## title` of the configuration content in `file/xxx.md`;

### 2.3. Favicon

```markdown
## icon

`image/f.ico`
```

### 2.4. Page Keywords

```markdown
## keywords

markdown website md web site
```

### 2.5. Rendering Mode

```markdown
## mode

upc
```

Optional items:

- `ucp`
- `text` 默认；

### 2.6. Header

```markdown
## header

### logo

![logo](image/logo.png)

### nav

- [Show](index.php)
- [Text](index.php?f=text)
- [config](index.php?f=config)
```

[Demo](http://forw.cc/markdown-website/demo/?f=header)

### 2.7. Ending

```markdown
## ending

### left-1

- [page](index.php?f=page)
- [unit](index.php?f=unit)
- [card](index.php?f=card)
- [pop](index.php?f=pop)

### left-2

- [header](index.php?f=header)
- [footer](index.php?f=footer)
- [ending](index.php?f=ending)

### left-3

- [Show](index.php)
- [Text](index.php?f=text)
- [config](index.php?f=config)

### right

Simply use markdown files  
to build a website
```

[Demo](http://forw.cc/markdown-website/demo/?f=ending)

### 2.8. Footer

```markdown
## footer

Copyright © 2021 forw.cc  
All rights reserved
```

[Demo](http://forw.cc/markdown-website/demo/?f=footer)

## 3. Access Specific Data File

- `?f={filename}`
- `?f={dir}/{filename}`

## 4. Rendering Mode

### 4.1. `ucp`

Render in unit/card/pop (ucp) mode:

| Markdown   | Web              |
| ---------- | ---------------- |
| h1         | html head title  |
| h1 content | page description |
| h2         | unit             |
| h2 content | unit description |
| h3         | card             |
| h3 content | card description |
| h4         | pop              |
| h4 content | pop description  |

[Demo](http://forw.cc/markdown-website/demo/)

### 4.2. `text`

[Demo](http://forw.cc/markdown-website/demo/?f=text)
