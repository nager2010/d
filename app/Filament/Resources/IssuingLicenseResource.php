<?php

namespace App\Filament\Resources;

use App\Enum\LicenseType;
use App\Filament\Resources\IssuingLicenseResource\Pages;
use App\Models\IssuingLicense;
use App\Models\Municipality;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;


class IssuingLicenseResource extends Resource

{

    protected static ?string $model = IssuingLicense::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'اصدار الرخص';



    public static function form(Forms\Form $form): Forms\Form
    {

        return $form
            ->schema([
                Wizard::make([
                    // المرحلة الأولى: البيانات الشخصية
                    Step::make('البيانات الشخصية')
                        ->description('أدخل المعلومات الشخصية')
                        ->schema([
                            TextInput::make('fullName')
                                ->label('الاسم الرباعي')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('nationalID')
                                ->label('الرقم الوطني')
                                ->required()
                                ->maxLength(20),
                            TextInput::make('passportOrID')
                                ->label('رقم جواز أو بطاقة')
                                ->maxLength(20),
                            TextInput::make('phoneNumber')
                                ->label('رقم الهاتف')
                                ->tel()
                                ->required()
                                ->maxLength(15),
                        ]),

                    // المرحلة الثانية: بيانات الرخصة
                    Step::make('بيانات الرخصة')
                        ->description('أدخل تفاصيل الرخصة')
                        ->schema([
                            TextInput::make('projectName')
                                ->label('اسم المشروع')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('positionInProject')
                                ->label('صفتك في المشروع')
                                ->maxLength(50),
                            TextInput::make('projectAddress')
                                ->label('عنوان المشروع')
                                ->maxLength(255),
                            Select::make('municipality_id')
                                ->label('البلدية')
                                ->default('سبها')
                                ->options(Municipality::pluck('name', 'id')) // يجلب الاسم و المعرف لكل بلدية
                                ->searchable() // يسمح بالبحث في القائمة
                                ->required(),
                            TextInput::make('region')
                                ->label('المحلة')
                                ->required()
                                ->maxLength(50),
                            TextInput::make('nearestLandmark')
                                ->label('أقرب نقطة دالة')
                                ->maxLength(100),
                            Select::make('license_type')
                                ->label('نوع الترخيص')
                                ->options([
                                    LicenseType::Company->value => LicenseType::Company->label(),
                                    LicenseType::IndividualActivity->value => LicenseType::IndividualActivity->label(),
                                ])
                                ->required(),
                            DatePicker::make('licenseDate')
                                ->label('تاريخ اليوم')
                                ->required()
                                ->default(now()),
                            TextInput::make('licenseNumber')
                                ->label('رقم الترخيص')
                                ->maxLength(15)
                                ->required()
                                ->default(fn () => Str::random(10)),
                        ]),

                    // المرحلة الثالثة: بيانات الدفع
                    Step::make('بيانات الدفع')
                        ->description('أدخل تفاصيل الدفع')
                        ->schema([
                            TextInput::make('licenseDuration')
                                ->label('مدة الترخيص')
                                ->numeric()
                                ->required(),
                            TextInput::make('licenseFee')
                                ->label('رسوم الترخيص')
                                ->numeric()
                                ->required(),
                            TextInput::make('discount')
                                ->label('نسبة الخصم')
                                ->numeric(),
                        ]),

                    // المرحلة الرابعة: بيانات أخرى
                    Step::make('بيانات أخرى')
                        ->description('معلومات إضافية')
                        ->schema([
                            TextInput::make('chamberOfCommerceNumber')
                                ->label('رقم قيد الغرفة التجارية')
                                ->maxLength(20),
                            TextInput::make('taxNumber')
                                ->label('الرقم الضريبي')
                                ->maxLength(20),
                            TextInput::make('economicNumber')
                                ->label('رقم الاقتصاد')
                                ->maxLength(20),
                        ]),
                ]),
            ])->columns(1);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('fullName')->label('الاسم الرباعي')->searchable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('nationalID')->label('الرقم الوطني')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('passportOrID')->label('رقم جواز أو بطاقة')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('phoneNumber')->label('رقم الهاتف')->searchable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('projectName')->label('اسم المشروع')->searchable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('positionInProject')->label('صفتك في المشروع')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('projectAddress')->label('عنوان المشروع')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('municipality')->label('البلدية')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('region')->label('المحلة')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nearestLandmark')->label('أقرب نقطة دالة')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('licenseType')->label('نوع الترخيص')->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('licenseDate')->label('تاريخ اليوم')->date()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('licenseNumber')->label('رقم الترخيص')->searchable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('licenseDuration')->label('مدة الترخيص')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('licenseFee')->label('رسوم الترخيص')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('discount')->label('نسبة الخصم')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('chamberOfCommerceNumber')->label('رقم قيد الغرفة التجارية')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('taxNumber')->label('الرقم الضريبي')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('economicNumber')->label('رقم الاقتصاد')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->label('تاريخ الإنشاء')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->label('تاريخ التحديث')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIssuingLicenses::route('/'),
            'create' => Pages\CreateIssuingLicense::route('/create'),
            'edit' => Pages\EditIssuingLicense::route('/{record}/edit'),
        ];
    }

}
