<template>
	<view class="main">
		<view class="card">
			<view class="title">入驻信息</view>
			<view class="item">
				<view class="left">姓名</view>
				<view class="right">
					<input placeholder="请输入姓名" />
				</view>
			</view>
			<view class="item">
				<view class="left">性别</view>
				<view class="right">
					<u-radio-group v-model="value" placement="row">
						<u-radio activeColor="#AE38D7" label="男"></u-radio>
						<u-radio activeColor="#AE38D7" label="女"></u-radio>
					</u-radio-group>
				</view>
			</view>
			<view class="item">
				<view class="left">年龄</view>
				<view class="right">
					<input placeholder="请输入年龄" />
				</view>
			</view>
			<view class="item">
				<view class="left">从业年限</view>
				<view class="right">
					<input placeholder="请输入从业年限" />
				</view>
			</view>

			<view class="item">
				<view class="left">服务时长（个案小时数）</view>
				<view class="right">
					<input placeholder="请输入服务时长" />
				</view>
			</view>
			<view class="item">
				<view class="left">所在城市</view>
				<view class="right">
					<input placeholder="请输入所在城市" />
				</view>
			</view>
			<view class="item">
				<view class="left">咨询方式</view>
				<view class="right">
					<u-radio-group v-model="value" placement="row">
						<u-radio activeColor="#AE38D7" label="线上"></u-radio>
						<u-radio activeColor="#AE38D7" label="线下"></u-radio>
					</u-radio-group>
				</view>
			</view>
			<view class="item">
				<view class="left">收费标准</view>
				<view class="right">
					<input placeholder="请输入收费标准" />
				</view>
			</view>

			<view class="item">
				<view class="left">照片</view>
			</view>
			<view class="item1">
				<view class="miaoshu">1.数量1-5张，照片要高清；</view>
				<view class="miaoshu">2.可以是形象照+工作照+场景照。</view>
			</view>
			<view class="item2">
				<u-upload :fileList="fileList1" @afterRead="afterRead" @delete="deletePic" name="1" multiple
					:maxCount="10"></u-upload>
			</view>

			<view class="item">
				<view class="left">资质证书（头衔）</view>
			</view>
			<view class="item2">
				<u-upload :fileList="fileList1" @afterRead="afterRead" @delete="deletePic" name="1" multiple
					:maxCount="10"></u-upload>
			</view>

			<view class="item"  @click="show = true">
				<view class="left">擅长领域</view>
				<view class="right">
					<view class="xuanze">
						<view class="text">请选择</view>
						<image src="../../static/img/jiantou-r.png"></image>
					</view>
				</view>
			</view>
			<u-picker :show="show" :columns="columns" @change="show=false"></u-picker>
			
			<view class="item"  @click="show = true">
				<view class="left">选择困扰</view>
				<view class="right">
					<view class="xuanze">
						<view class="text">请选择</view>
						<image src="../../static/img/jiantou-r.png"></image>
					</view>
				</view>
			</view>
			<u-picker :show="show" :columns="columns" @change="show=false"></u-picker>
			
			<view class="item"  @click="show = true">
				<view class="left">擅长人群</view>
				<view class="right">
					<view class="xuanze">
						<view class="text">请选择</view>
						<image src="../../static/img/jiantou-r.png"></image>
					</view>
				</view>
			</view>
			<u-picker :show="show" :columns="columns" @change="show=false"></u-picker>

			<view class="item">
				<view class="left">擅长流派</view>
				<view class="right">
					<input placeholder="请输入擅长流派" />
				</view>
			</view>
			<view class="item">
				<view class="left">咨询风格</view>
				<view class="right">
					<input placeholder="请输入咨询风格" />
				</view>
			</view>

			<view class="item">
				<view class="left">培训经历</view>
			</view>
			<view class="item1">
				<view class="miaoshu">包括心理学相关教育经历；各段受训经历起止时间、课程名称；督导与体验经历。</view>
			</view>
			<view class="item2">
				<u--textarea v-model="value1" placeholder="请输入培训经历"></u--textarea>
			</view>

			<view class="item">
				<view class="left">咨询寄语：</view>
			</view>
			<view class="item2">
				<u--textarea v-model="value1" placeholder="请输入咨询寄语"></u--textarea>
			</view>

		</view>

		<view style="height: 150rpx;"></view>
		<view class="btn">提交</view>

	</view>
</template>

<script>
	export default {
		data() {
			return {
				// value: '男'
				show: false,
				columns: [
					['选项一', '选项二']
				],
			};
		},

	}
</script>

<style lang="scss" scoped>
	.main {
		padding-top: 20rpx;
		background-color: #F6F6F6;
		min-height: 100vh;

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