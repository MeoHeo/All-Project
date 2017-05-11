import math

from pip.utils import FakeFile

def BoardCopy(board):
    new_board = [[]] * 8
    for i in range(8):
        new_board[i] = [] + board[i]
    return new_board

def doit(move, state):
    new_state = BoardCopy(state)
    # Move one step
    # example: [(2,2),(3,3)] or [(2,2),(3,1)]
    if len(move) == 2 and abs(move[1][0] - move[0][0]) == 1:
        new_state[move[0][0]][move[0][1]] = '.'
        if state[move[0][0]][move[0][1]] == 'b' and move[1][0] == 7:
            new_state[move[1][0]][move[1][1]] = 'B'
        elif state[move[0][0]][move[0][1]] == 'r' and move[1][0] == 0:
            new_state[move[1][0]][move[1][1]] = 'R'
        else:
            new_state[move[1][0]][move[1][1]] = state[move[0][0]][move[0][1]]
    # Jump
    # example: [(1,1),(3,3),(5,5)] or [(1,1),(3,3),(5,1)]
    else:
        step = 0
        new_state[move[0][0]][move[0][1]] = '.'
        while step < len(move) - 1:
            new_state[int(math.floor((move[step][0] + move[step + 1][0]) / 2))][
                int(math.floor((move[step][1] + move[step + 1][1]) / 2))] = '.'
            step = step + 1
        if state[move[0][0]][move[0][1]] == 'b' and move[step][0] == 7:
            new_state[move[step][0]][move[step][1]] = 'B'
        elif state[move[0][0]][move[0][1]] == 'r' and move[step][0] == 0:
            new_state[move[step][0]][move[step][1]] = 'R'
        else:
            new_state[move[step][0]][move[step][1]] = state[move[0][0]][move[0][1]]
    return new_state

class Move:
    def __init__(self, move=[]):
        self.move = move

OppDic = {'b': ['r', 'R'], 'r': ['b', 'B'], 'B': ['r', 'R'], 'R': ['b', 'B']}
PawnToKingDic = {'r': 'R', 'b': 'B'}
PlayerDic = {'r':['r','R'],'b':['b','B'],'R':['r','R'],'B':['b','B']}
OppDicBasic = {'b': 'r', 'r': 'b'}

# ======================== Class Player =======================================
class Player:
    def __init__(self, str_name):
        self.str = str_name

    def __str__(self):
        return self.str

    def findListJump(self, state, row, col, step):
        result = []
        if state[row][col] == 'b':
            # (1,1)
            if row <= 5 and col <= 5 and (state[row + 1][col + 1] == 'r' or state[row + 1][col + 1] == 'R') and \
                            state[row + 2][col + 2] == '.':
                newState = doit([(row, col), (row + 2, col + 2)], state)
                tempList = self.findListJump(newState, row + 2, col + 2, step + 1)
                for index in tempList:
                    index.move = [(row, col)] + index.move
                result = result + tempList
            # (1,-1)
            if row <= 5 and col >= 2 and (state[row + 1][col - 1] == 'r' or state[row + 1][col - 1] == 'R') and \
                            state[row + 2][col - 2] == '.':
                newState = doit([(row,col),(row+2,col-2)],state)
                tempList = self.findListJump(newState, row + 2, col - 2, step + 1)
                for index in tempList:
                    index.move = [(row, col)] + index.move
                result = result + tempList
            if not result and step >= 1:
                result = [Move(move=[(row, col)])]
        elif state[row][col] == 'r':
            # (-1,1)
            if row >= 2 and col <= 5 and (state[row - 1][col + 1] == 'b' or state[row - 1][col + 1] == 'B') and \
                            state[row - 2][col + 2] == '.':
                newState = doit([(row,col),(row-2,col+2)],state)
                tempList = self.findListJump(newState, row - 2, col + 2, step + 1)
                for index in tempList:
                    index.move = [(row, col)] + index.move
                result = result + tempList
            # (-1,-1)
            if row >= 2 and col >= 2 and (state[row - 1][col - 1] == 'b' or state[row - 1][col - 1] == 'B') and \
                            state[row - 2][col - 2] == '.':
                newState = doit([(row,col),(row-2,col-2)],state)
                tempList = self.findListJump(newState, row - 2, col - 2, step + 1)
                for index in tempList:
                    index.move = [(row, col)] + index.move
                result = result + tempList
            if not result and step >= 1:
                result = [Move(move=[(row, col)])]
        elif state[row][col] == 'B' or state[row][col] == 'R':
            # Jump:  upper right - B/R move
            if row <= 5 and col <= 5 and (state[row + 1][col + 1] in OppDic[self.str]) and state[row + 2][
                        col + 2] == '.':
                newState = doit([(row, col), (row + 2, col + 2)], state)
                tempList = self.findListJump(newState, row + 2, col + 2, step + 1)
                for index in tempList:
                    index.move = [(row, col)] + index.move
                result = result + tempList
            # Jump:  upper left - B/R move
            if row <= 5 and col >= 2 and (state[row + 1][col - 1] in OppDic[self.str]) and state[row + 2][
                        col - 2] == '.':
                newState = doit([(row, col), (row + 2, col - 2)], state)
                tempList = self.findListJump(newState, row + 2, col - 2, step + 1)
                for index in tempList:
                    index.move = [(row, col)] + index.move
                result = result + tempList
            # Jump: down right - B/R move
            if row >= 2 and col <= 5 and (state[row - 1][col + 1] in OppDic[self.str]) and state[row - 2][
                        col + 2] == '.':
                newState = doit([(row, col), (row - 2, col + 2)], state)
                tempList = self.findListJump(newState, row - 2, col + 2, step + 1)
                for index in tempList:
                    index.move = [(row, col)] + index.move
                result = result + tempList
            # Jump: down left - B/R move
            if row >= 2 and col >= 2 and (state[row - 1][col - 1] in OppDic[self.str]) and state[row - 2][
                        col - 2] == '.':
                newState = doit([(row, col), (row - 2, col - 2)], state)
                tempList = self.findListJump(newState, row - 2, col - 2, step + 1)
                for index in tempList:
                    index.move = [(row, col)] + index.move
                result = result + tempList
            if not result and step >= 1:
                result = [Move(move=[(row, col)])]
        return result

    # move+jump:
    def findListAll(self, state):
        listMove = []
        listJump = []
        for row in range(8):
            for col in range(8):
                if self.str == 'b':
                    # move + jum
                    if state[row][col] == 'b':
                        if row + 1 < 8 and col - 1 >= 0:
                            if state[row + 1][col - 1] == '.':
                                listMove += [[(row, col), (row + 1, col - 1)]]
                        if row + 1 < 8 and col + 1 < 8:
                            if state[row + 1][col + 1] == '.':
                                listMove += [[(row, col), (row + 1, col + 1)]]
                    #     find jump:
                        listJump += self.findListJump(state, row, col, 0)
                        # for index in range(len(listJump)):
                        #     listMove+=[listJump[index].move]
                    elif state[row][col]=='B':
                        if row + 1 < 8 and col - 1 >= 0:
                            if state[row + 1][col - 1] == '.':
                                listMove += [[(row, col), (row + 1, col - 1)]]
                        if row + 1 < 8 and col + 1 < 8:
                            if state[row + 1][col + 1] == '.':
                                listMove += [[(row, col), (row + 1, col + 1)]]
                        if row - 1 >= 0 and col - 1 >= 0:
                            if state[row - 1][col - 1] == '.':
                                listMove += [[(row, col), (row - 1, col - 1)]]
                        if row - 1 >= 0 and col + 1 < 8:
                            if state[row - 1][col + 1] == '.':
                                listMove += [[(row, col), (row - 1, col + 1)]]

                        #     find jump:
                        listJump += self.findListJump(state, row, col, 0)
                        # for index in range(len(listJump)):
                        #     listMove+=[listJump[index].move]
                # ==========================================================
                elif self.str == 'r':
                    if state[row][col] == 'r':  # r
                        if row - 1 >= 0 and col - 1 >= 0:
                            if state[row - 1][col - 1] == '.':
                                listMove += [[(row, col), (row - 1, col - 1)]]
                        if row - 1 >= 0 and col + 1 < 8:
                            if state[row - 1][col + 1] == '.':
                                listMove += [[(row, col), (row - 1, col + 1)]]

                     #     find jump:
                        listJump += self.findListJump(state, row, col, 0)
                        # for index in range(len(listJump)):
                        #     listMove+=[listJump[index].move]

                    elif state[row][col]=='R':  # R
                        if row + 1 < 8 and col - 1 >= 0:
                            if state[row + 1][col - 1] == '.':
                                listMove += [[(row, col), (row + 1, col - 1)]]
                        if row + 1 < 8 and col + 1 < 8:
                            if state[row + 1][col + 1] == '.':
                                listMove += [[(row, col), (row + 1, col + 1)]]
                        if row - 1 >= 0 and col - 1 >= 0:
                            if state[row - 1][col - 1] == '.':
                                listMove += [[(row, col), (row - 1, col - 1)]]
                        if row - 1 >= 0 and col + 1 < 8:
                            if state[row - 1][col + 1] == '.':
                                listMove += [[(row, col), (row - 1, col + 1)]]
                        #     find jump:
                        listJump += self.findListJump(state, row, col, 0)
                        # for index in range(len(listJump)):
                        #     listMove+=[listJump[index].move]
        listTemp = []
        for index in range(len(listJump)):
            listTemp += [listJump[index].move]
        if listTemp != []:
            listAll = listTemp
        else:
            listAll = listMove

        return listAll

    def heuristicEval(self, state):
        #     return luong gia nuoc di
        val = 0
        opponent = OppDicBasic[self.str]

        for i in range(8):
            for j in range(8):
                # number of the king and man
                if state[i][j] == self.str:
                    val = val + 2
                elif state[i][j] == PawnToKingDic[self.str]:
                    val = val + 4
                elif state[i][j] == opponent:
                    val = val - 2
                elif state[i][j] == PawnToKingDic[opponent]:
                    val = val - 4
        return val

    def terminalNode(self, state, maximizingPlayer):
        if maximizingPlayer:
            listMove = self.findListAll(state)
            if listMove == []:
                return True
            else:
                return False
        else:
            opponent = OppDicBasic[self.str]
            oppPlayer = Player(opponent)
            listMove = oppPlayer.findListAll(state)
            if listMove == []:
                return True
            else:
                return False
        #     function alphabeta(node, depth, α, β, maximizingPlayer)
# 02      if depth = 0 or node is a terminal node
# 03          return the heuristic value of node
# 04      if maximizingPlayer
# 05          v := -∞
# 06          for each child of node
# 07              v := max(v, alphabeta(child, depth – 1, α, β, FALSE))
# 08              α := max(α, v)
# 09              if β ≤ α
# 10                  break (* β cut-off *)
# 11          return v
# 12      else
# 13          v := +∞
# 14          for each child of node
# 15              v := min(v, alphabeta(child, depth – 1, α, β, TRUE))
# 16              β := min(β, v)
# 17              if β ≤ α
# 18                  break (* α cut-off *)
# 19          return v
    def alpha_beta(self, state, depth, alpha, beta, maximizingPlayer):

        if depth == 0 or self.terminalNode(state, maximizingPlayer) == True:
            return [self.heuristicEval(state), []]
        if maximizingPlayer:
            listMove = self.findListAll(state)
        else:
            opponent = OppDicBasic[self.str]
            oppPlayer = Player(opponent)
            listMove = oppPlayer.findListAll(state)
        bestMove = listMove[0]
        if maximizingPlayer:
            value = -10000
            for move in listMove:
                oldValue = value
                value = max(value, self.alpha_beta(doit(move, state), depth - 1, alpha, beta, False)[0])
                alpha = max(alpha, value)
                if oldValue != value:
                    bestMove = move
                if beta <= alpha:
                    break
            return [value,bestMove]
        else:
            value = 10000
            for move in listMove:
                oldValue = value
                value = min(value, self.alpha_beta(doit(move, state), depth - 1, alpha, beta, True)[0])
                beta = min(beta, value)
                if oldValue != value:
                    bestMove = move
                if beta <= alpha:
                    break
            return [value,bestMove]

    # Student MUST implement this function
    # The return value should be a move that is denoted by a list of tuples
    def nextMove(self, state):
        # alphabeta(origin, depth, -∞, +∞, TRUE)
        result = self.alpha_beta(state, 4, -10000, 10000, True)
        return result[1]