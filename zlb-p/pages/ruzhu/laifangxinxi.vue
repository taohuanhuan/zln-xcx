<template>
	<view class="main">
		<view class="card">
			<view class="title">来访信息填写</view>
			<view class="item">
				<view class="left"><text class="required">*</text>真实姓名</view>
				<view class="right">
					<input placeholder="请输入真实姓名" />
				</view>
			</view>
			<view class="item">
				<view class="left"><text class="required">*</text>年龄</view>
				<view class="right">
					<input placeholder="请输入年龄" />
				</view>
			</view>
			<view class="item">
				<view class="left"><text class="required">*</text>性别</view>
				<view class="right">
					<u-radio-group v-model="value" placement="row">
						<u-radio activeColor="#AE38D7" label="男"></u-radio>
						<u-radio activeColor="#AE38D7" label="女"></u-radio>
					</u-radio-group>
				</view>
			</view>

		</view>

		<view class="card">
			<view class="title">紧急联系人<text class="title-desc">严格保密，请放心填写</text></view>
			<view class="item">
				<view class="left"><text class="required">*</text>真实姓名</view>
				<view class="right">
					<input placeholder="请输入真实姓名" />
				</view>
			</view>
			<view class="item" @click="show = true">
				<view class="left"><text class="required">*</text>Ta是您的</view>
				<view class="right">
					<view class="xuanze">
						<view class="text">请选择</view>
						<image src="../../static/img/jiantou-r.png"></image>
					</view>
				</view>
			</view>
			<u-picker :show="show" :columns="columns" @change="show=false"></u-picker>
			<view class="item">
				<view class="left"><text class="required">*</text>联系电话</view>
				<view class="right">
					<input placeholder="请输入联系电话" />
				</view>
			</view>

		</view>

		<view class="card">
			<view class="title">其他信息<text class="title-desc">帮助咨询师了解你并评估你们是否匹配</text></view>
			<view class="item">
				<view class="left">咨询目标：</view>
			</view>
			<view class="item2">
				<u--textarea v-model="value1" placeholder="请输入咨询目标"></u--textarea>
			</view>
			<view class="item" @click="show = true">
				<view class="left">现居城市</view>
				<view class="right">
					<view class="xuanze">
						<view class="text">请选择</view>
						<image src="../../static/img/jiantou-r.png"></image>
					</view>
				</view>
			</view>
			<u-picker :show="show" :columns="columns" @change="show=false"></u-picker>
			<view class="item" @click="show = true">
				<view class="left">职业</view>
				<view class="right">
					<view class="xuanze">
						<view class="text">请选择</view>
						<image src="../../static/img/jiantou-r.png"></image>
					</view>
				</view>
			</view>
			<u-picker :show="show" :columns="columns" @change="show=false"></u-picker>
			<view class="item" @click="show = true">
				<view class="left">情感状态</view>
				<view class="right">
					<view class="xuanze">
						<view class="text">请选择</view>
						<image src="../../static/img/jiantou-r.png"></image>
					</view>
				</view>
			</view>
			<u-picker :show="show" :columns="columns" @change="show=false"></u-picker>
			<view class="item" @click="show = true">
				<view class="left">有无子女</view>
				<view class="right">
					<view class="xuanze">
						<view class="text">请选择</view>
						<image src="../../static/img/jiantou-r.png"></image>
					</view>
				</view>
			</view>
			<u-picker :show="show" :columns="columns" @change="show=false"></u-picker>


			<view class="item1">
				<view class="sub-title"><text class="required">*</text>是否有精神科服药史或者就医史</view>
				<view class="s-g">
					<!-- <u-checkbox-group>
						<u-checkbox v-model="checked" activeColor="#AE38D7" shape="circle" label="是(请填写或上传精神科诊断资料或者就医史信息)"></u-checkbox>
					</u-checkbox-group> -->
					<u-radio-group v-model="value" placement="column">
						<u-radio shape="circle" activeColor="#AE38D7" label="是(请填写或上传精神科诊断资料或者就医史信息)"></u-radio>
						<view class="item2">
							<u-upload :fileList="fileList1" @afterRead="afterRead" @delete="deletePic" name="1" multiple
								:maxCount="10"></u-upload>
						</view>
						<u-radio shape="circle" activeColor="#AE38D7" label="否"></u-radio>
					</u-radio-group>
				</view>
				<!-- <view class="item2">
					<u-upload :fileList="fileList1" @afterRead="afterRead" @delete="deletePic" name="1" multiple
						:maxCount="10"></u-upload>
				</view> -->

				<!-- 		<view class="s-g">
					<u-radio-group v-model="value">
						<u-radio shape="circle" activeColor="#AE38D7" label="否"></u-radio>
					</u-radio-group>
				</view> -->
			</view>

			<view class="item">
				<view class="left">是否是圆融学员</view>
				<view class="right">
					<u-radio-group v-model="value" placement="row">
						<u-radio activeColor="#AE38D7" label="是"></u-radio>
						<u-radio activeColor="#AE38D7" label="否"></u-radio>
					</u-radio-group>
				</view>
			</view>

			<view class="item">
				<view class="left">是否正在一段心理咨询中</view>
				<view class="right">
					<u-radio-group v-model="value" placement="row">
						<u-radio activeColor="#AE38D7" label="是"></u-radio>
						<u-radio activeColor="#AE38D7" label="否"></u-radio>
					</u-radio-group>
				</view>
			</view>

		</view>


		<teleport v-if="gouxuan===false">
			<view class="xieyi">
				<image class="icon" src="../../static/img/gouxuan.png" @click="gouxuan=true"></image>
				<view class="tiaoyue">我同意并签署<text style="color:#242424">《软件使用协议》</text></view>
			</view>
		</teleport>
		<teleport v-if="gouxuan===true">
			<view class="xieyi">
				<image class="icon" src="../../static/img/xuanzhong.png" @click="gouxuan=false"></image>
				<view class="tiaoyue">我同意并签署<text style="color:#242424">《软件使用协议》</text></view>
			</view>
		</teleport>




		<view style="height: 150rpx;"></view>
		<view class="btn">确认新增</view>

	</view>
</template>

<script>
	export default {
		data() {
			return {
				// value: '男'
				gouxuan: false,
				show: false,
				columns: [
					['选项一', '选项二']
				],
			};
		},

	}
</script>

<style lang="scss" scoped>
	.required {
		color: red;
	}

	.s-g {
		margin-top: 30rpx;
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

			.item1 {
				.miaoshu {
					font-weight: 400;
					font-size: 24rpx;
					color: #666666;
				}
			}

			.item2 {
				margin-top: 20rpx;
			}
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