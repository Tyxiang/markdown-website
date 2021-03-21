# 基于 GitLab 的工作方法

## 1. 新建项目过程

### 1.1. 产品负责人

1. 整理资源；
1. 新建项目，初始化 master 分支；
1. 通过文件夹结构初始化[项目配置](项目配置)；
1. 编制 `README.md`；
1. 编制产品需求；

## 2. 新增特性过程

### 2.1. 开发负责人

1. 拆解需求；
1. 设定里程碑
   - 标题格式 `<阶段号>.<n>`；
   - 标题示例 `v1.1`、`v1.101`；
1. 新建 feature issue；
1. 组织讨论；
1. 定人；
1. 定期；
1. 定里程碑；

### 2.2. 程序员

1. [克隆](clone)服务器上的库到本地；
1. [新建](creat-branch)特性分支；
   - 分支名称 `feature-<issues id>`；
   - 名称示例 `feature-#10`；
1. [切换](check-out)到新建的分支；
1. 完成代码开发；
1. [添加](add)一批修改；
1. [注释并提交](commit)这些修改到本地库；
1. [推送](push)本地库到服务器；
1. 提 Merge Requests；

### 2.3. 开发负责人

1. 查验；
1. 合并/驳回；
1. 关闭 feature issue；

## 3. 测试过程

### 3.1. 测试负责人

1. 新建 test issues；
   - 被测目标（test tag）；
   - 测试方法；
   - 测试重点；
   - 测试结果；
1. 新建 test tag；
1. 组织讨论；
1. 定人；
1. 定期；
1. 定里程碑；

### 3.2. 测试员

1. [克隆](clone)服务器上的库到本地；
1. 编译；
1. 烧写；
1. 运行脚本实施测试；
1. 发现异常；
   - 老 bug，重新打开 issues；
   - 新 bug，新建 bug issues，描述；
   - 新建 feature issue；
1. test issues 总结；

### 3.3. 测试负责人

- 查验；
- 关闭 test issues；

## 4. 缺陷修补过程

### 4.1. 开发负责人

1. 组织讨论 bug issue；
1. 定性；
1. 定人；
1. 定期；
1. 定里程碑；

### 4.2. 程序员

1. [克隆](clone)服务器上的库到本地；
1. [新建](creat-branch)修复分支；
   - 分支名称 `hotfix-<issues id>`；
   - 名称示例 `hotfix-#1`；
1. [切换](check-out)到新建的分支；
1. 完成代码开发；
1. [添加](add)一批修改；
1. [注释并提交](commit)这些修改到本地库；
1. [推送](push)本地库到服务器；
1. 提 Merge Requests；

### 4.3. 开发负责人

1. 查验；
1. 合并/驳回；
1. 关闭 bug issue；

## 5. 发行过程

### 5.1. 开发负责人

1. 确定里程碑完成；
1. 新建 release issue；
1. 组织讨论；

### 5.2. 产品负责人

- 确认；

### 5.3. 测试负责人

1. 确认；
1. 在 test tag 处增加 release tag；
    - 名称格式 `release-<版本号>`；
    - 名称示例 `release-v1.1`；
1. 关闭 release issue；
    
## 6. 需求分析、技术决策等其他过程

1. 任何人新建 discuss issue；
1. 讨论；
1. 作者总结结论；
1. 作者关闭 discuss issue；

## 7. 参考

- [Git 官方手册](pro-git.pdf)
- [Markdown 教程](https://www.runoob.com/markdown/md-title.html)
