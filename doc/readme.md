# Manual

## 1. 数据文件

- 用来定义页面的 markdown 数据文件放在 `file/` 下；
- 数据文件中 `# CONFIG` 下为配置内容，其他一级标题为页面内容；
- `file/Config.md` 为默认配置文件；
- `file/Default.md` 为默认页面文件；
- `file/xxx.md` 为其他页面文件；
- 数据文件中的页面内容会替换 `file/Config.md` 中的页面内容；
- 数据文件中的配置内容会更新 `file/Config.md` 中的配置内容；

## 2. 配置项

### 2.1. 网站名称

```markdown
## name

website name
```

### 2.2. 页面标题

```markdown
## title

page title
```

标题优先级从低到高：

1. `Config.md` 中的 `# CONFIG ## title`；
1. `file/xxx.md` 中，页面内容的 `# {title}`；
1. `file/xxx.md` 中，配置内容的 `# CONFIG ## title`；

### 2.3. 标题栏图标

```markdown
## icon

`image/f.ico`
```

### 2.4. 页面关键词

```markdown
## keywords

markdown website md web site
```

### 2.5. 渲染模式

```markdown
## mode

show
```

可选项：

- `show`
- `text`

### 2.6. header

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

### 2.7. ending

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

### 2.8. footer

```markdown
## footer

Copyright © 2021 forw.cc  
All rights reserved
```

[Demo](http://forw.cc/markdown-website/demo/?f=footer)

## 3. 指定数据文件

`?f={filename}`

## 4. 渲染模式

### 4.1. show

以 unit/card/pop（ucp）方式渲染：

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

### 4.2. text

[Demo](http://forw.cc/markdown-website/demo/?f=text)
