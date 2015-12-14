## 需求是这样的：
- 有公司表和帖子表，一个公司对应于多个帖子。

## 问题来了：
- 现在想用一条sql搞定这个业务需求：查询出指定四个公司的帖子，*要求每个公司只查询出做多3条。*

## 我写出一半，但是*每个公司只查询出做多3条* 这部分没控制住：
抛砖引玉:
```
select po.puid,co.company_name from jobfairs_post as po inner join (select company_id,company_name from jobfairs_company where city_id=12 order by add_time desc limit 4) as co on po.company_id=co.company_id order by po.add_time desc
```
# 求攻略,急,在线等..
