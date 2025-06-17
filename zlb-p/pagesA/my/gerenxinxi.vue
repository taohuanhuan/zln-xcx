<template>
	<view class="main">
		<view class="card" v-if="user">
			<view class="item" @click="upload">
				<view class="left">头像</view>
				<view class="right">
					<image class="avatar" :src="user.resident_avator  | avatarFilter"></image>
					<image class="icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			<view class="item" @click="navPage('/pages/my/nicheng?word='+user.nickname)">
				<view class="left">昵称</view>
				<view class="right">
					<view class="text">{{user.nickname}}</view>
					<image class="icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			<view class="item" @click="navPage('/pages/my/xingming?word='+user.resident_name)">
				<view class="left">姓名</view>
				<view class="right">
					<view class="text">{{user.resident_name}}</view>
					<image class="icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			<view class="item" @click="showSex">
				<view class="left">性别</view>
				<view class="right">
					<view class="text">{{user.resident_sex|sexFilter}}</view>
					<image class="icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			<view class="item" @click="navPage('/pages/my/age?word='+user.resident_age)">
				<view class="left">年龄</view>
				<view class="right">
					<view class="text">{{user.resident_age}}</view>
					<image class="icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			<view class="item">
				<view class="left">角色</view>
				<view class="right">
					<u-radio-group v-model="value1" placement="row">
						<u-radio activeColor="#AE38D7" :label="item.name" v-for="(item, index) in roles" :key="index"
							:name="item.name" @change="radioChange"></u-radio>

					</u-radio-group>
				</view>
			</view>

			<view class="item" @click="navPage('/pages/my/jiaren')">
				<view class="left">家人</view>
				<view class="right">
					<view class="text"></view>
					<image class="icon" src="../../static/img/jiantou-r.png"></image>
				</view>
			</view>
			<view class="item">
				<view class="left">用户档案</view>
				<view class="right">
					<u-switch v-model="value3" size="20" activeColor="#00AF6A" @change="changeIsopen"></u-switch>
					<view style="width: 20rpx;"></view>
					<view class="text1">隐私</view>
				</view>
			</view>

			<view class="user-dangan" v-if="user.resident_path">
				<view class="doc">用户档案信息.word</view>
				<view class="btn" @click="downLoadFile(`${user.resident_path}`)">下载</view>
			</view>

		</view>
		<u-picker ref="uPicker" showToolbar="false" :show="show" :columns="columns" @cancel="closedShow"
			@confirm='changeSex'></u-picker>
	</view>
</template>

<script>
	import {
		getResidentInfo,
		updateResidentInfo,
		uploadFile
	} from '@/config/api.js';

	import {
		DOMAIN
	} from '@/config/config.js';

	export default {
		data() {
			return {
				value1: '本人',
				value3: false,
				show: false,
				columns: [
					['男', '女']
				],
				roles: [{
						id: 1,
						name: "本人"
					},
					{
						id: 2,
						name: "代诊"
					}
				],
				user: null
			};
		},
		onShow() {
			getResidentInfo().then((data) => {
				this.user = data

				if (this.user.resident_role == 1) {
					this.value1 = '本人'
				} else {
					this.value1 = '代诊'
				}

				if (this.user.isopen == 0) {
					this.value3 = false
				} else {
					this.value3 = true
				}

			})
		},
		methods: {
			downLoadFile(file) {
				console.log(DOMAIN + file)
				uni.downloadFile({
					url: DOMAIN + file,
					success(data) {
						uni.saveFile({
							tempFilePath: data.tempFilePath,
							success: function(res) {
								uni.showToast({
									icon: 'none',
									mask: true,
									title: '文件已保存：' + res.savedFilePath, //保存路径
									duration: 3000,
								});
								// setTimeout(() => {
								// 	//打开文档查看
								// 	uni.openDocument({
								// 		filePath: res.savedFilePath,
								// 		success: function(res) {
								// 			// console.log('打开文档成功');
								// 		}
								// 	});
								// }, 3000)
							}

						})
					}
				})
			},
			changeIsopen(e) {
				let value = e == false ? 0 : 1;
				updateResidentInfo({
					isopen: value
				}).then((data) => {

				})
			},
			radioChange(n) {
				console.log('radioChange', n);
				let value = n == '本人' ? 1 : 2;
				updateResidentInfo({
					resident_role: value
				}).then((data) => {

				})
			},
			navPage(url) {
				uni.navigateTo({
					url
				})
			},
			upload() {
				let that = this
				uni.chooseImage({
					count: 1, //默认9
					sizeType: ['original', 'compressed'], //可以指定是原图还是压缩图，默认二者都有
					sourceType: ['album'], //从相册选择
					success: function(res) {
						console.log(JSON.stringify(res.tempFilePaths));
						uploadFile({
							filePath: res.tempFilePaths[0],
							name: 'file[]',
						}).then((data)=>{
							// 修改头像地址
							updateResidentInfo({
								resident_avator:data.url
							}).then((re)=>{
								getResidentInfo().then((data) => {
									that.user = data
								
									if (that.user.resident_role == 1) {
										that.value1 = '本人'
									} else {
										that.value1 = '代诊'
									}
								
									if (that.user.isopen == 0) {
										that.value3 = false
									} else {
										that.value3 = true
									}
								})
							})
						})
					}
				});
			},
			showSex() {
				this.show = true
			},
			closedShow() {
				this.show = false
			},
			changeSex(e) {
				const {
					columnIndex,
					index,
					picker = this.$refs.uPicker
				} = e
				let sexValue = e.indexs[0] + 1
				console.log(sexValue)
				updateResidentInfo({
					resident_sex: sexValue
				}).then((data) => {
					this.user.resident_sex = sexValue
					this.show = false
				})
			}
		},
		filters: {
			sexFilter(value) {
				return value == 1 ? '男' : '女'
			}
		}

	}
</script>

<style lang="scss" scoped>
	.main {
		padding-top: 20rpx;
		background-color: #F6F6F6;
		min-height: 100vh;
		width: 690rpx;

		.card {
			background-color: white;
			padding: 30rpx;
			box-sizing: border-box;
			border-radius: 16rpx;

			.title {
				font-weight: bold;
				font-size: 32rpx;
				color: #242424;
			}

			.item {
				height: 88rpx;
				display: flex;
				justify-content: space-between;
				border-bottom: 1px solid #F6F6F6;
				align-items: center;

				.left {
					font-weight: 400;
					font-size: 28rpx;
					color: #242424;

				}

				.right {
					display: flex;
					align-items: center;

					input {
						text-align: right;
						font-size: 28rpx;
						color: #999999;
					}

					.icon {
						width: 30rpx;
						height: 30rpx;
					}

					.avatar {
						width: 88rpx;
						height: 88rpx;
						border-radius: 50%;
					}

					.tag {
						display: flex;

						.item {
							font-weight: 400;
							font-size: 20rpx;
							color: #7F6FDF;
							font-weight: 400;
							font-size: 20rpx;
							color: #7F6FDF;
							margin-left: 10rpx;
						}
					}

					.text {
						font-weight: 400;
						font-size: 28rpx;
						color: #242424;
					}

					.text1 {
						font-weight: 400;
						font-size: 24rpx;
						color: #242424;
					}
				}

			}
		}

	}

	// .btn {
	// 	position: fixed;
	// 	bottom: 0;
	// 	width: 690rpx;
	// 	height: 88rpx;
	// 	background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
	// 	border-radius: 44rpx;
	// 	font-weight: bold;
	// 	font-size: 28rpx;
	// 	color: #FFFFFF;
	// 	line-height: 88rpx;
	// 	text-align: center;
	// }

	.user-dangan {
		.doc {
			font-weight: 400;
			font-size: 24rpx;
			color: #AE38D7;
		}

		.btn {
			width: 108rpx;
			height: 52rpx;
			border-radius: 30rpx;
			border: 2rpx solid #AE38D7;
			font-weight: 400;
			font-size: 24rpx;
			color: #AE38D7;
			text-align: center;
			line-height: 52rpx;
			margin-top: 30rpx;
		}
	}
</style>