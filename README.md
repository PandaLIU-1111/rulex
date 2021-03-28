# 规则引擎

> Beta 版本

一款使用 hyperf 写的规则引擎。

# 表结构

- 规则表
    - ID
    - 名字
    - code
    - 规则内容
    - 匹配规则
    - 创建人（TODO）
    - 创建时间
    - 修改时间
    

# 接口

- 创建规则
- 修改规则
- 执行规则
- 规则列表
- 脚本检查


# 页面

- 规则列表
    - 规则名称
    - 规则匹配规则
    - 规则体
    - 操作
        - 执行规则
        - 编辑规则
    

- 添加规则页面
    - 规则名称
    - 规则匹配规则
    - 规则体
    - 按钮组
        - 提交
        - 取消
    
- 执行规则页面
    - json数组填充数据
    

# 规则模板语法定义

```
 方法调用
 call($methodName, ...params);
 
 获取参数
 getVariable($path);
 
 设置参数
 setVariable($value, $path);
 
 
 $myVariable = getVariable();
 
```
 

## call可调用的内置的方法

`httpRequest($method, $url, $body, $haders)`

|  参数名称  |  默认值    | 传参说明  |  传参示例  |
|  :----:   |  :----:  |   :----: |   :----: |
| `$method` |    'GET'   |    请求方法   |    GET   |
| `$url` |    ''   |    请求连接   |    'http://www.baidu.com'   |
| `$body` |    []   |    请求参数   |    ['k' => 'v']   |
| `$haders` |   []  |    请求参数   |    ['content-type' => 'application/json']    |
