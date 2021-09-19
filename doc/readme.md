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

name
```

### 2.2. 页面标题

```markdown
## title

title
```

### 2.3. 标题栏图标

```markdown
## icon
```

### 2.4. 页面关键词

```markdown
## keywords
```

### 2.5. 渲染模式

```markdown
## mode
```

### 2.6. header

```markdown
## header

### logo

### nav
```

### 2.7. ending

```markdown
## ending

### left-1

### left-2

### left-3

### right
```

### 2.8. footer

```markdown
## footer
```

## 3. 查询

`?f={filename}`

## 4. 模式

### 4.1. show

- page
- unit
- card
- pop

[Demo](http://forw.cc/markdown-website/demo/)

### 4.2. text

[Demo](http://forw.cc/markdown-website/demo/?f=text)
