#!/bin/sh

# for dir in $(ls -d */)
# do
#   if [ -d "$dir"/.git ]; then
#     echo "$dir" && cd "$dir" && git fetch && git checkout 17kx && cd ..
#   fi
# done

date_begin="2016-01-01";
date_end="2016-09-10";
beg_t=`date -d "$date_begin" +%s`;
end_t=`date -d "$date_end" +%s`;

while [ "$beg_t" -le "$end_t" ];do
    day=`date -d @$beg_t +"%Y-%m-%d"`;
    echo $day;
    echo "//"$day>>./app/Http/routes.php && git commit -am "day day up" --date=$day
    beg_t=$((beg_t+86400));
done