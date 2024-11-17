# CSP203_project_calorieTracker

## Main Goal of this project 
1. ->user to track his daily intake (cal)
1. ->track all the necessary activites (which are required for reach user’s personal goal.)

## Main Features of this project
1. -> food tracking- add food item that user had, then we have to update user intake data of the day(protien,carbs,fats etc).(this feature mainly requiers us to get the data if that food item from any external database)  
1. ->provide a ideal goal calories intake based on the the goal that user wants to achieve.

> [!IMPORTANT]
> to reset data each you have to use the commands below
  crontab -e
  0 0 * * * php /path/to/your/project/reset_data.php
  (Replace /path/to/your/project/ with the actual path to the files)





     