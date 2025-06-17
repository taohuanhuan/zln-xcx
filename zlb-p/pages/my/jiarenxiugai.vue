<template>
	<view class="main">
		<view class="card">
			<view class="title">家人基础信息</view>
			<view class="item">
				<view class="left">联系人姓名</view>
				<view class="right">
					<input placeholder="请输入姓名" v-model="user.username" />
				</view>
			</view>
			<view class="item">
				<view class="left">联系方式</view>
				<view class="right">
					<input placeholder="请输入联系方式" v-model="user.mobile" />
				</view>
			</view>

		</view>
		<view class="btn" @click="addFamily">确认修改</view>

	</view>
</template>

<script>
	import {
		editFamilyMember
	} from '@/config/api.js';
	export default {
		data() {
			return {
				fileList: [{
						url: 'https://img01.yzcdn.cn/vant/leaf.jpg'
					},
					{
						url: 'https://cloud-image',
						isImage: true
					},
				],
				user: {
					
				}
			};
		},
		onLoad(options) {
			console.log(JSON.parse(options.user))
			this.user = JSON.parse(options.user)
		},
		methods: {
			addFamily() {
				let u = {
					family_item_id :this.user.family_item_id,
					member_name:this.user.username,
					member_phone:this.user.mobile,
					isNormal:0
				}
				editFamilyMember(u).then((data) => {
					uni.navigateBack()
				})
			}
		}

	}
</script>

<style lang="scss" scoped>
	.main {
		// padding-left: 30rpx;
		// padding-right: 30rpx;
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
					input {
						text-align: right;
						font-size: 28rpx;
						color: #999999;
					}
				}

			}

			.upload {
				margin-top: 20rpx;
			}
		}

	}

	.btn {
		position: fixed;
		bottom: 50rpx;
		width: 690rpx;
		height: 88rpx;
		background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
		border-radius: 44rpx;
		font-weight: bold;
		font-size: 28rpx;
		color: #FFFFFF;
		line-height: 88rpx;
		text-align: center;
	}
</style>