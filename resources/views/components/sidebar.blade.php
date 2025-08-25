<flux:sidebar sticky class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Purity Cylinder Gases" class="px-2 dark:hidden" />
    <flux:brand href="#" logo="{{ asset('PurityCylinderGases.png') }}"  name="Purity Cylinder Gases" class="hidden dark:flex" />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="home" badge="{{ $taskCount }}"  href="{{ route('tasks.index') }}" current>My Tasks</flux:navlist.item>
        <flux:navlist.item icon="inbox" href="{{ route('tasks.create') }}">Add Task</flux:navlist.item>
        <flux:navlist.item icon="document-text" href="{{ route('documentation') }}">Documentation</flux:navlist.item>
        <flux:navlist.item icon="calendar" href="#">Calendar</flux:navlist.item>
    </flux:navlist>

    <flux:spacer />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>
        <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
    </flux:navlist>
</flux:sidebar>
