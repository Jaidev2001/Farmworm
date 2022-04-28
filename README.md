# Farmworm
A complete solution for a farmer


## Getting started

1) Fork this repository (Click the Fork button in the top right of this page, click your Profile Image)
2) Clone your fork down to your local machine

`git clone https://github.com/your-username/Data-Structure.git`

3) Create a branch

`git checkout -b branch-name`

4) Make your changes (choose from any task listed above)
5) Commit and push

```bash
git add .
git commit -m 'Commit message'
git push origin branch-name
```

6) Create a new pull request from your forked repository (Click the New Pull Request button located at the top of your repo)
7) Wait for your PR review and merge approval!
8) Star this repository if you had fun!



## Getting Started :scroll:

### 1. Fork it :fork_and_knife:

Get a fork/copy of this repository by clicking on <a href="https://github.com/Jaidev2001/Farmworm/fork"><kbd><b>Fork</b></kbd></a> button.

[![Fork Button](https://help.github.com/assets/images/help/repository/fork_button.jpg)](https://github.com/Jaidev2001/Farmworm/fork)

### 2. Clone it :busts_in_silhouette:

Clone it into your local PC by using

```sh
$ git clone https://github.com/Jaidev2001/Farmworm
```

> This command creates a copy of this repository in your machine.

After cloning this repository, move into this repository by using

```sh
# This will change directory to Sorting-Algorithm
$ cd Farmworm/
```

### 3. Setting up :arrow_up:

Below are the following commands to see your *local copy* has a reference to your *forked repository* in Github :octocat:

```sh
# Here YourUserName is your Github User name
$ git remote -v
origin	https://github.com/Jaidev2001/Farmworm.git (fetch)
origin	https://github.com/Jaidev2001/Farmworm.git (push)
```

Add reference to this repository by using

```sh
$ git remote add main https://github.com/Jaidev2001/Farmworm
```

> This command adds a new remote named **main**.

To see the changes, run the following command

```sh
$ git remote -v
main	https://github.com/Jaidev2001/Farmworm.git (fetch)
main	https://github.com/Jaidev2001/Farmworm.git (push)
origin  https://github.com/Jaidev2001/Farmworm.git (fetch)
origin  https://github.com/Jaidev2001/Farmworm.git (push)
```

### 4. Synchronize :recycle:

Always make sure to update your local repository with this repository before making any changes.

```sh
# Fetch all remote repositories & delete any deleted remote branches
$ git fetch --all --prune

# Switch to `master` branch
$ git checkout master

# Reset local `master` branch to match `main` remote repository's `master` branch
$ git reset --hard main/master

# Push changes to your forked `Farmworm` repository
$ git push origin master
```

Now you are ready to start contributing and sending pull requests.

## Contribute

You are freely welcome to send a pull request on any sorting algorithm, typo correction, bug. Your contribution will be highly appreciable :thumbsup:. When you want to contribute to this repository then create a another branch and send a [new pull request](https://github.com/Jaidev2001/Farmworm) here.

Create an another branch for contribution.

```sh
# This will create a new branch `test` & switch to `test` branch
$ git checkout -b test
```

To add your changes to the branch

```sh
# To add all your files to branch `test`
$ git add .
```

Commit a new info or message for your changes

```sh
# This message will show in your all files that you have changed
$ git commit -m 'message or info for your changes'
```

Push your changes to your remote repository

```sh
# To push your changes to your remote repository in test branch
$ git push -u origin test
```

Voila !!! Then head towards to your repository in any browser and click on `compare and pull requests`. Then add a title & description to your pull request that explains what you have done.

## Tech/Framework Used
+ [VSCODE](https://code.visualstudio.com/) (A source code editor)