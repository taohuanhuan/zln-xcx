<template>
	<view class="main">
		<view class="card">
			<view class="title">受督者信息</view>
			<view class="item">
				<view class="left"><text class="required">*</text>真实姓名</view>
				<view class="right">
					<input placeholder="请输入真实姓名" v-model="residentName" />
				</view>
			</view>
			<view class="item">
				<view class="left"><text class="required">*</text>年龄</view>
				<view class="right">
					<input placeholder="请输入年龄" v-model="residentAge" />
				</view>
			</view>
			<view class="item">
				<view class="left"><text class="required">*</text>性别</view>
				<view class="right">
					<u-radio-group v-model="residentSex" placement="row">
						<u-radio activeColor="#AE38D7" label="男" name="1" @change="changeSex(1)"></u-radio>
						<u-radio activeColor="#AE38D7" label="女" name="2" @change="changeSex(2)"></u-radio>
					</u-radio-group>
				</view>
			</view>
			<view class="item">
				<view class="left"><text class="required">*</text>联系电话</view>
				<view class="right">
					<input placeholder="请输入" v-model="contacts_mobile" />
				</view>
			</view>
			<view class="item">
				<view class="left"><text class="required">*</text>从业年限</view>
				<view class="right">
					<input placeholder="请输入" v-model="consultant_practice_time" />
				</view>
			</view>
			<view class="item">
				<view class="left"><text class="required">*</text>服务时长（个案小时数）</view>
				<view class="right">
					<input placeholder="请输入" v-model="service_time" />
				</view>
			</view>
			<view class="item">
				<view class="left"><text class="required">*</text>擅长流派</view>
				<view class="right">
					<input placeholder="请输入" v-model="consultant_sect" />
				</view>
			</view>
			<view class="item2">
				<view class="left"><text class="required">*</text>问题简述</view>
				<view class="">
					<u--textarea v-model="problem_desc" placeholder="描述遇到的主要问题"></u--textarea>
				</view>
			</view>
			<view class="item2">
				<view class="left"><text class="required">*</text>督导目的</view>
				<view class="">
					<u--textarea v-model="service_target" placeholder="说明想通过督导达到的效果和目的"></u--textarea>
				</view>
			</view>
			<view class="item2">
				<view class="left">特殊情况说明</view>
				<view class="">
					<u--textarea v-model="situation_description" placeholder="请输入"></u--textarea>
				</view>
			</view>
			<view class="item">
				<view class="left">是否是圆融签约咨询师</view>
				<view class="right">
					<u-radio-group v-model="isVip" placement="row">
						<u-radio activeColor="#AE38D7" label="是" name="1" @change="changeYuanrun(1)"></u-radio>
						<u-radio activeColor="#AE38D7" label="否" name="2" @change="changeYuanrun(0)"></u-radio>
					</u-radio-group>
				</view>
			</view>
		</view>

		<view class="item1">

			<view class="s-g">
				<u-checkbox-group v-model="checked">
					<u-checkbox activeColor="#AE38D7" shape="circle" name="已阅读并同意" label="已阅读并同意"
						@change="changeXieyi"></u-checkbox>
				</u-checkbox-group>
				<view class="text" @click="navPage('/pagesA/doc/xieyi?id=16')">《网络督导知情同意书》</view>

			</view>

		</view>

		<view style="height: 150rpx;"></view>
		<view class="btn" @click="submit">提交</view>

	</view>
</template>

<script>
	import {
		addSupervisionVisitingSurvey,
		getVisitingSurveyDetails
	} from '@/config/api.js';

	export default {
		data() {
			return {
				gouxuan: false,
				checked: [],
				residentName: '',
				residentAge: '',
				residentSex: '',
				contacts_mobile: '',
				consultant_practice_time: '',
				service_time: '',
				consultant_sect: '',
				problem_desc: '',
				service_target: '',
				situation_description: '',
				isVip: '',
				check: false,
				visit_id: ''
			};
		},
		onLoad(options) {
			this.visit_id = options.visit_id

			if (options.visit_id) {
				getVisitingSurveyDetails({
					visiting_survey_id: this.visit_id
				}).then((data) => {
					this.residentName = data.resident_name
					this.residentSex = data.resident_sex
					this.residentAge = data.resident_age
					this.contactsName = data.contacts_name
					this.contacts_mobile = data.contacts_mobile
					this.service_target = data.service_target
					this.isVip = data.is_vip

					this.check = true
				})
			}
		},
		methods: {
			navPage(url) {
				uni.navigateTo({
					url
				})
			},
			submit() {
				if (!this.check) {
					uni.showToast({
						icon: 'none',
						title: '请先确认协议'
					})

					return false
				}
				const params = {
					residentName: this.residentName,
					residentAge: this.residentAge,
					residentSex: this.residentSex,
					contacts_mobile: this.contacts_mobile,
					consultant_practice_time: this.consultant_practice_time,
					service_time: this.service_time,
					consultant_sect: this.consultant_sect,
					problem_desc: this.problem_desc,
					service_target: this.service_target,
					situation_description: this.situation_description,
					isVip: this.isVip,
				}

				addSupervisionVisitingSurvey(params).then((data) => {
					if (typeof data == 'object') {
						uni.showToast({
							icon: 'none',
							title: data.msg
						})
					} else {
						uni.$emit('laifang', {
							'id': data
						})
						uni.navigateBack()
					}
				})
			},
			changeYuanrun(e) {
				this.isVip = e
			},
			changeSex(e) {
				this.residentSex = e
			},
			changeXieyi(e) {
				console.log(e)
				this.check = e
			}
		}
	}
</script>

<style lang="scss" scoped>
	.required {
		color: red;
	}

	.s-g {
		margin-top: 30rpx;
		display: flex;

		.text {
			font-weight: 400;
			font-size: 28rpx;
			color: #242424;
		}
	}

	.title-desc {
		font-weight: 400;
		font-size: 24rpx;
		color: #999999;
		margin-left: 30rpx;
	}

	.main {
		padding-top: 20rpx;
		background-color: #F6F6F6;
		min-height: 100vh;

		.card {
			background-color: white;
			padding: 30rpx;
			box-sizing: border-box;
			border-radius: 16rpx;
			margin-bottom: 30rpx;

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

					.xuanze {
						display: flex;
						align-items: center;

						.text {
							font-weight: 400;
							font-size: 28rpx;
							color: #999999;
						}

						image {
							width: 30rpx;
							height: 30rpx;
						}
					}

				}
			}

			.item2 {
				margin-bottom: 20rpx;

				.left {
					font-weight: 400;
					font-size: 28rpx;
					color: #242424;
					margin-bottom: 20rpx;
				}

				.right {
					input {
						text-align: right;
						font-size: 28rpx;
						color: #999999;
					}

					.xuanze {
						display: flex;
						align-items: center;

						.text {
							font-weight: 400;
							font-size: 28rpx;
							color: #999999;
						}

						image {
							width: 30rpx;
							height: 30rpx;
						}
					}

				}
			}


			.item1 {
				.miaoshu {
					font-weight: 400;
					font-size: 24rpx;
					color: #666666;
				}
			}

			// .item2 {
			// 	margin-top: 20rpx;
			// }
		}

	}


	.xieyi {
		display: flex;
		align-items: center;

		.tiaoyue {
			font-weight: 400;
			font-size: 28rpx;
			color: #999999;
			margin-left: 30rpx;
		}

		.icon {
			width: 30rpx;
			height: 30rpx;
			border-radius: 50%;
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