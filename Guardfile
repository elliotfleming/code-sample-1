# More info at https://github.com/guard/guard#readme

# Disable System Notifications
#guard --notify false

notification :'terminal-notifier-guard'

guard 'phpunit', :cli => '--colors', :tests_path => 'app/tests', :all_on_start => true, :all_after_pass => true, :keep_failed => true do
    watch(%r{^.+Test\.php$})

    watch(%r{app/(.+)/(.+).php}) { |m| "app/tests/#{m[1]}/#{m[2]}Test.php" }

    watch(%r{^app/views/.+$}) { Dir.glob('tests/\**/*Test.php') }
end
