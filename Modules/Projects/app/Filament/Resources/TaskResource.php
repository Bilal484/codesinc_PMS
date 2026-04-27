<?php

namespace Modules\Projects\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Projects\Filament\Resources\TaskResource\Pages;
use Modules\Projects\Models\Task;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationGroup = 'Project Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Task')
                    ->columnSpanFull()
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Details')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Forms\Components\RichEditor::make('description')
                                    ->columnSpanFull(),
                                Forms\Components\Select::make('project_id')
                                    ->relationship('project', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\Select::make('milestone_id')
                                    ->relationship('milestone', 'title')
                                    ->searchable()
                                    ->preload(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Assignment & Status')
                            ->icon('heroicon-o-user-group')
                            ->columns(2)
                            ->schema([
                                Forms\Components\Select::make('assigned_to')
                                    ->relationship('assignee', 'name')
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\Select::make('status')
                                    ->options([
                                        'backlog' => 'Backlog',
                                        'todo' => 'To Do',
                                        'in_progress' => 'In Progress',
                                        'in_review' => 'In Review',
                                        'done' => 'Done',
                                        'cancelled' => 'Cancelled',
                                    ])
                                    ->default('backlog')
                                    ->required(),
                                Forms\Components\Select::make('priority')
                                    ->options([
                                        'low' => 'Low',
                                        'medium' => 'Medium',
                                        'high' => 'High',
                                        'critical' => 'Critical',
                                    ])
                                    ->default('medium')
                                    ->required(),
                                Forms\Components\TextInput::make('estimated_hours')
                                    ->numeric()
                                    ->suffix('hours'),
                                Forms\Components\DatePicker::make('start_date'),
                                Forms\Components\DatePicker::make('due_date')
                                    ->after('start_date'),
                                Forms\Components\Select::make('labels')
                                    ->relationship('labels', 'name')
                                    ->multiple()
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')->required(),
                                        Forms\Components\ColorPicker::make('color')->default('#6366f1'),
                                    ]),
                            ]),
                        Forms\Components\Tabs\Tab::make('Attachments')
                            ->icon('heroicon-o-paper-clip')
                            ->schema([
                                Forms\Components\SpatieMediaLibraryFileUpload::make('attachments')
                                    ->collection('attachments')
                                    ->multiple()
                                    ->reorderable()
                                    ->downloadable()
                                    ->openable(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(50),
                Tables\Columns\TextColumn::make('project.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'backlog',
                        'info' => 'todo',
                        'primary' => 'in_progress',
                        'warning' => 'in_review',
                        'success' => 'done',
                        'danger' => 'cancelled',
                    ]),
                Tables\Columns\BadgeColumn::make('priority')
                    ->colors([
                        'gray' => 'low',
                        'info' => 'medium',
                        'warning' => 'high',
                        'danger' => 'critical',
                    ]),
                Tables\Columns\TextColumn::make('assignee.name')
                    ->label('Assignee')
                    ->sortable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->sortable()
                    ->color(fn (Task $record) => $record->due_date?->isPast() && $record->status !== 'done' ? 'danger' : null),
                Tables\Columns\TextColumn::make('milestone.title')
                    ->label('Milestone')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'backlog' => 'Backlog',
                        'todo' => 'To Do',
                        'in_progress' => 'In Progress',
                        'in_review' => 'In Review',
                        'done' => 'Done',
                        'cancelled' => 'Cancelled',
                    ])
                    ->multiple(),
                Tables\Filters\SelectFilter::make('priority')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                        'critical' => 'Critical',
                    ]),
                Tables\Filters\SelectFilter::make('project_id')
                    ->relationship('project', 'name')
                    ->label('Project')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('assigned_to')
                    ->relationship('assignee', 'name')
                    ->label('Assignee')
                    ->searchable()
                    ->preload(),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
            'kanban' => Pages\KanbanTasks::route('/kanban'),
        ];
    }
}
