
#coding
import threading
import urllib.request
import sys
import time
import datetime
import os

def ipdz(url):
	# 打开传入的网址
	resp = urllib.request.urlopen(url)
	# 读取网页源码内容
	data = str(resp.read(),'utf-8')
	return data
name=input("你好，请输入你的姓名：")
print("你好啊！",name)
print("感谢你使用圣骑士军团发布的免费的IP分区工具")
nowTime=datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')
print("现在的时间是",nowTime)
print("你目前使用的平台是",sys.platform)
print("\n")
wjm=input("请键入你的txt文件：")
wb=open(wjm,"r")
wb1=wb.read()
wbsz=wb1.split("\n")
#print(wbsz)
#dz=ipdz("http://ip.taobao.com/service/getIpInfo.php?ip=222.187.56.232")
#dz=dz.decode("utf-8").encode("gbk")
#dz1=dz.decode("gbk")
#print(dz)
ccz=os.path.exists("zg.txt")
bcz=os.path.exists("wg.txt")

if(ccz==False):
	f=open("zg.txt",'a')
if(bcz==False):
	f=open("wg.txt",'a')
zg=open("zg.txt","w")
wg=open("wg.txt","w")
for i in wbsz:
	#print("http://ip.taobao.com/service/getIpInfo.php?ip="+i)
	dz=ipdz("http://ip.taobao.com/service/getIpInfo.php?ip="+i)
	a=dz.find("中国")
	if(a != -1):
		#print("no")
		print(i+"  is ok!")
		zg.write(i+"\n")
	else:
		print(i+"  is no!")
		wg.write(i+"\n")
print("\n")
nowTime=datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')
print("现在的时间是",nowTime)
a=input("完成分国，请查看当前目录的zg.txt和wg.txt")
os.exit()


#作者：China-CZX
#QQ:3045831167
#github:www.github.com/China-CZX
#blog:www.yjxzx.pw
