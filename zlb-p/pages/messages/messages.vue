<template>
	<scroll-view class="form-page" scroll-y>
		<!-- 基本信息 -->
		<view class="section-title">基本信息</view>
		<view class="form-item">
			<view class="form-label">昵称</view>
			<view class="form-input-wrap">
				<u-input v-model="form.nickname" placeholder="请输入昵称" border="none" />
			</view>
		</view>
		<view class="form-item">
			<view class="form-label">身份证号</view>
			<view class="form-input-wrap">
				<u-input v-model="form.idCard" placeholder="请输入身份证号" border="none" />
			</view>
		</view>
		<view class="form-item">
			<view class="form-label">微信号</view>
			<view class="form-input-wrap">
				<u-input v-model="form.wechat" placeholder="请输入微信号" border="none" />
			</view>
		</view>
		<view class="form-item">
			<view class="form-label">所在区域</view>
			<view class="form-input-wrap" @click="showRegion = true">
				<text class="picker-text">{{ form.regionLabel || '请选择所在区域' }}</text>
			</view>
			<u-picker mode="region" :show="showRegion" @confirm="onRegionConfirm" @cancel="showRegion = false" />
		</view>
		<view class="form-item">
			<view class="form-label">婚姻状态</view>
			<view class="form-input-wrap">
				<u-radio-group  @change="onMaritalChange">
				<u-radio style="margin-right: 30px;" name="未婚" label="未婚" />
				<u-radio name="离异" label="离异" />
				<u-radio name="丧偶" label="丧偶" />
				</u-radio-group>
			</view>

		</view>
		</view>
		<view class="form-item" v-if="['离异','丧偶'].includes(form.maritalStatus)">
			<view class="form-item">
				<view class="form-label">是否有小孩</view>
				<view class="form-input-wrap">
					<u-radio-group class="marital-group" v-model="form.hasChild">
						<u-radio name="没有" label="没有" />
						<u-radio name="男孩" label="男孩" />
						<u-radio name="女孩" label="女孩" />
					</u-radio-group>
				</view>
			</view>
		</view>
		<!-- 个人资本 -->
		<view class="section-title">个人资本</view>
		<view class="form-item">
			<view class="form-label">收入区间</view>
			<view class="form-input-wrap" @click="showIncome=true">
				<text class="picker-text">{{ form.incomeRange||'请选择收入区间' }}</text>
			</view>
			<u-picker mode="selector" :range="incomeOptions" :show="showIncome" @confirm="onIncomeConfirm"
				@cancel="showIncome=false" />
		</view>
		<view class="form-item">
			<view class="form-label">是否有车</view>
			<view class="form-input-wrap">
				<u-radio-group class="marital-group" v-model="form.hasCar">
					<u-radio name="有" label="有" />
					<u-radio name="无" label="无" />
					<u-radio name="分期" label="分期" />
				</u-radio-group>
			</view>
		</view>
		<view class="form-item">
			<view class="form-label">是否有房</view>
			<view class="form-input-wrap">
				<u-radio-group class="marital-group" v-model="form.hasHouse">
					<u-radio name="有" label="有" />
					<u-radio name="无" label="无" />
					<u-radio name="与父母同住" label="与父母同住" />
				</u-radio-group>
			</view>
		</view>
		<view class="form-item">
			<view class="form-label">兴趣爱好</view>
			<view class="form-input-wrap tag-wrap">
				<u-checkbox-group v-model="form.hobbies">
					<u-checkbox v-for="h in hobbyOptions" :key="h" :name="h">{{h}}</u-checkbox>
				</u-checkbox-group>
			</view>
		</view>
		<view class="form-item">
			<view class="form-label">生活方式</view>
			<view class="form-input-wrap tag-wrap">
				<u-checkbox-group v-model="form.lifestyle">
					<u-checkbox v-for="l in lifestyleOptions" :key="l" :name="l">{{l}}</u-checkbox>
				</u-checkbox-group>
			</view>
		</view>

		<!-- 择偶条件 -->
		<view class="section-title">择偶条件</view>
		<view class="form-item">
			<view class="form-label">加分项</view>
			<view class="form-input-wrap tag-wrap">
				<view v-for="(t,i) in form.addPoints" :key="i" class="tag">
					<text>{{t}}</text><text class="tag-remove" @click="removePoint(i)">×</text>
				</view>
			</view>
			<view class="form-input-wrap add-tag-wrap">
				<u-input v-model="newPoint" placeholder="添加加分项" border="none" @confirm="addPoint" />
				<u-button size="small" color="#BB4FE1" @click="addPoint">添加</u-button>
			</view>
		</view>
		<view class="form-item">
			<view class="form-label">绝对不能接受</view>
			<view class="form-input-wrap tag-wrap">
				<view v-for="(t,i) in form.cannotAccept" :key="i" class="tag">
					<text>{{t}}</text><text class="tag-remove" @click="removeCannot(i)">×</text>
				</view>
			</view>
			<view class="form-input-wrap add-tag-wrap">
				<u-input v-model="newCannot" placeholder="添加标签" border="none" @confirm="addCannot" />
				<u-button size="small" color="#BB4FE1" @click="addCannot">添加</u-button>
			</view>
		</view>

		<!-- 提交 -->
		<view class="submit-btn-wrap">
			<u-button type="primary" color="#BB4FE1" @click="submit">提交</u-button>
		</view>
	</scroll-view>
</template>

<script>
        import { getProfileOptions, getProfileInfo, saveProfileInfo } from '@/config/api'
        export default {
                data() {
                        return {
                                showRegion: false,
				showIncome: false,
				useRadioForMarital: true,
				incomeOptions: ['<5k', '5-10k', '10-20k', '20k+'],
				hobbyOptions: ['跑步', '旅行', '阅读', '健身', '电影'],
				lifestyleOptions: ['抽烟', '饮酒', '不熬夜', '爱干净', '信佛'],
				newPoint: '',
				newCannot: '',
				form: {
					nickname: '',
					idCard: '',
					wechat: '',
					regionLabel: '',
					regionCode: '',
					maritalStatus: '',
					hasChild: '',
					incomeRange: '',
					hasCar: '',
					hasHouse: '',
					hobbies: [],
					lifestyle: [],
					addPoints: [],
					cannotAccept: []
				}
                                };
                },
                created() {
                        this.loadOptions();
                        this.loadInfo();
                },
                methods: {
			onRegionConfirm(e) {
				const {
					province,
					city,
					county,
					town
				} = e;
				this.form.regionLabel = `${province.label}-${city.label}-${county.label}-${town.label}`;
				this.form.regionCode = town.code;
				this.showRegion = false;
			},
			onIncomeConfirm(e) {
				this.form.incomeRange = this.incomeOptions[e.index];
				this.showIncome = false;
			},
			onMaritalChange(e) {
				if (['离异', '丧偶'].includes(e.value)) {
					this.useRadioForMarital = false;
				}
			},
			selectMarital(val) {
				this.form.maritalStatus = val;
				this.useRadioForMarital = true;
			},
			addPoint() {
				if (this.newPoint && !this.form.addPoints.includes(this.newPoint)) {
					this.form.addPoints.push(this.newPoint);
				}
				this.newPoint = '';
			},
			removePoint(i) {
				this.form.addPoints.splice(i, 1);
			},
			addCannot() {
				if (this.newCannot && !this.form.cannotAccept.includes(this.newCannot)) {
					this.form.cannotAccept.push(this.newCannot);
				}
				this.newCannot = '';
			},
			removeCannot(i) {
				this.form.cannotAccept.splice(i, 1);
			},
                        async loadOptions() {
                                try {
                                        const res = await getProfileOptions()
                                        this.incomeOptions = res.data.incomeOptions
                                        this.hobbyOptions = res.data.hobbyOptions
                                        this.lifestyleOptions = res.data.lifestyleOptions
                                } catch (e) {
                                        console.log('load options fail', e)
                                }
                        },
                        async loadInfo() {
                                try {
                                        const res = await getProfileInfo()
                                        if (res.data) {
                                                Object.assign(this.form, res.data)
                                        }
                                } catch (e) {
                                        console.log('load info fail', e)
                                }
                        },
                        async submit() {
                                try {
                                        await saveProfileInfo(this.form)
                                        uni.showToast({
                                                title: '提交成功',
                                                icon: 'success'
                                        })
                                } catch (e) {
                                        uni.showToast({
                                                title: e.msg || '提交失败',
                                                icon: 'none'
                                        })
                                }
                        }
                }
        };
</script>

<style scoped>
	.form-page {
		background: #fff;
		padding-bottom: 200rpx;
	}

	.section-title {
		font-size: 32rpx;
		color: #333;
		margin: 40rpx 0 20rpx 12%;
	}

	.form-item {
		margin-bottom: 40rpx;
	}

	.form-label {
		color: #747474;
		font-size: 28rpx;
		margin-left: 12%;
		margin-bottom: 20rpx;
	}

	.form-input-wrap {
		margin-left: 8%;
		width: calc(84% - 24px);
		height: 120rpx;
		background: #f7f7f7;
		border-radius: 12rpx;
		display: flex;
		align-items: center;
		padding: 0 24rpx;
	}

	.picker-text {
		color: #999;
	}

	.btn-group u-button {
		margin-right: 20rpx;
	}

	.tag-wrap {
		flex-wrap: wrap;
	}

	.tag {
		background: #ececec;
		padding: 8rpx 12rpx;
		border-radius: 16rpx;
		margin-right: 12rpx;
		display: flex;
		align-items: center;
	}

	.tag-remove {
		margin-left: 8rpx;
		color: #999;
	}

	.add-tag-wrap {
		margin-left: 8%;
		width: 84%;
		height: auto;
		padding: 12rpx;
		background: #f7f7f7;
		border-radius: 12rpx;
		display: flex;
	}

	.submit-btn-wrap {
		padding: 40rpx 8%;
	}

	/* 保证水平排列 */
	.marital-group {
		display: flex;
		justify-content: space-between;
		width: 100%;
		background-color: aqua;
	}

	/* 深度选择 u-radio 组件，增加左右间距 */
	.marital-group>>>.u-radio {
		margin: 0 40rpx;
	}
</style>